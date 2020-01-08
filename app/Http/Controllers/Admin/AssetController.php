<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\AssetCategory;
use App\AssetLocation;
use App\AssetStatus;
use App\ClassificationDetail;
use App\IncidentReport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\User;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $data1 = DB::table('incident_reports')
        // ->join('category_incidents','incident_reports.cat_id','category_incidents.id')
        // ->select('name')->get();

        $data2 = DB::table('incident_reports')
        ->join('category_incidents','incident_reports.cat_id','category_incidents.id')
        ->select(DB::raw('name, count(*) as y'))
        ->groupBy('name')
        ->get();

        $data3 = DB::table('incident_reports')->select('status')
        ->groupBy('status')->get();

        // $countCorrective = DB::table('incident_reports')->select(DB::raw('cat_id, count(*) as y'))
        // ->where('status','Open')->groupBy('id')->get();
    
        // $countPreventive = DB::table('incident_reports')->select(DB::raw('perbaikan, count(*) as y'))
        // ->where('status','Close')->get();

        $countOpenCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('status','Open')
        ->where('perbaikan', '!=','NULL')->count();
        $countCloseCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('status','Close')
        ->where('perbaikan', '!=','NULL')->count();
        $countOpenPreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('status','Open')
        ->where('perbaikan', '!=','NULL')->count();
        $countClosePreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('status','Close')
        ->where('perbaikan', '!=','NULL')->count();

        $countPreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('pencegahan','!=','NULL')->count();

        $countCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('perbaikan','!=','NULL')->count();

        $countCloseCorrectivePreventive = $countCloseCorrective + $countClosePreventive;

        $countOpenCorrectivePreventive = $countOpenCorrective + $countOpenPreventive;

        $countCorrectivePreventive = $countPreventive + $countCorrective;
       
        $assets = Asset::all();
        // $matrixs = ClassificationDetail::all();
         $matrixs = ClassificationDetail::orderBy('classify_id')->orderBy('cat_id')->get();
        $rows = [];
        $columns = [];

        foreach ($matrixs as $index => $matrix) {
            // Create an empty a    rray if the key does not exist yet
            if(!isset($rows[$matrix->classify_id])) {
                $rows[$matrix->classify_id] = [];
            }
            
              // Add the column to the array of columns if it's not yet in there
            if(!in_array($matrix->cat_id, $columns)) {
                $columns[] = $matrix->cat_id;
            }
             // Add the grade to the 2 dimensional array
             $rows[$matrix->classify_id][$matrix->cat_id] = $matrix->description;
        }

        $data = [];

        $recordsByCategories = DB::table('incident_reports')->select('cat_id', DB::raw('count(*) as totalProducts'))
                    ->groupBy('cat_id')->get();

      
    
        return view('admin.assets.index', compact('assets','matrixs','rows','columns','data2','countOpenCorrective','countCloseCorrective','countOpenPreventive','countClosePreventive','countPreventive','countCorrective','countCorrectivePreventive','countCloseCorrectivePreventive','countOpenCorrectivePreventive'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assets.create', compact('categories', 'statuses', 'locations', 'assigned_tos'));
    }

    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->all());
        dd($request->input('photos'));
        foreach ($request->input('photos', []) as $file) {
            $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        return redirect()->route('admin.assets.index');
    }

    public function edit(Asset $asset)
    {
        abort_if(Gate::denies('asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = AssetCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AssetStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = AssetLocation::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset->load('category', 'status', 'location', 'assigned_to');

        return view('admin.assets.edit', compact('categories', 'statuses', 'locations', 'assigned_tos', 'asset'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());

        if (count($asset->photos) > 0) {
            foreach ($asset->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $asset->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $asset->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.assets.index');
    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->load('category', 'status', 'location', 'assigned_to');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
