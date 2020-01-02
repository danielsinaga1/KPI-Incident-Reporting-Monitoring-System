<?php

namespace App\Http\Controllers\Admin;

use App\ClassificationIncident;
use App\ClassificationDetail;
use App\CategoryIncident;
use App\Http\Requests\MassDestroyClassificationDetailRequest;
use App\Http\Requests\StoreClassificationDetailRequest;
use App\Http\Requests\UpdateClassificationDetailRequest;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ClassificationDetailController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('classification_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classificationDetails = ClassificationDetail::all();
        // $dt = $now->year;
        // $query1 = DB::table('incident_reports')->join('teams','incident_reports.team_id','=','teams.id')->select('incident_reports.*')->get();        
        // $year = Carbon::now()->format('y');
        // $month = Carbon::now()->format('m');
    
        return view('admin.classificationDetails.index', compact('classificationDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('classification_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $categoryIncidents = CategoryIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classifyIncidents = ClassificationIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.classificationDetails.create',compact('categoryIncidents','classifyIncidents'));
    }

    public function store(StoreClassificationDetailRequest $request)
    {
        $classificationDetail = ClassificationDetail::create($request->all());

        return redirect()->route('admin.classification-details.index');
    }

    public function edit(ClassificationDetail $classificationDetail)
    {
        abort_if(Gate::denies('classification_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoryIncidents = CategoryIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classifyIncidents = ClassificationIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classificationDetail->load('category_incident','classify_incident');
        

        return view('admin.classificationDetails.edit', compact('classificationDetail','categoryIncidents','classifyIncidents'));
    }

    public function update(UpdateClassificationDetailRequest $request, ClassificationDetail $classificationDetail)
    {
        $classificationIncident->update($request->all());

        return redirect()->route('admin.classification-details.index');
    }

    public function show(ClassificationDetail $classificationDetail)
    {
        abort_if(Gate::denies('classification_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.classificationDetails.show', compact('classificationDetail'));
    }

    public function destroy(ClassificationDetail $classificationDetail)
    {
        abort_if(Gate::denies('classification_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classificationDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassificationDetailRequest $request)
    {
        ClassificationDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
