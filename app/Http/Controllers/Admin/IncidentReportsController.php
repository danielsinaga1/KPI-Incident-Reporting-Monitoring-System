<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidentReportRequest;
use App\Http\Requests\StoreIncidentReportRequest;
use App\Http\Requests\UpdateIncidentReportRequest;
use App\IncidentReport;
use App\DesignationDepartment;
use App\RootCause;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
class IncidentReportsController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team']);
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'incident_report_show';
                $editGate      = 'incident_report_edit';
                $deleteGate    = 'incident_report_delete';
                $crudRoutePart = 'incident-reports';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('nama_pelapor_name', function ($row) {
                return $row->nama_pelapor ? $row->nama_pelapor->name : '';
            });

            $table->addColumn('dept_origin_name', function ($row) {
                // 
                // $data = DB::table('incident_reports')->select('team_id')->where('team_id','=','3')->get();
                // $data = DB::table('incident_reports')
                // ->join('teams','incident_reports.team_id','=','teams.id')
                // ->select('name')->get();
                // dd(json_encode($data));
                return $row->team ? $row->team->name : '';
            });

            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : "";
            });

            $table->addColumn('root_cause_root_cause', function ($row) {
                return $row->root_cause ? $row->root_cause->root_cause : '';
            });

            $table->editColumn('perbaikan', function ($row) {
                return $row->perbaikan ? $row->perbaikan : "";
            });
            $table->editColumn('pencegahan', function ($row) {
                return $row->pencegahan ? $row->pencegahan : "";
            });

            $table->addColumn('dept_designation_name', function ($row) {
                return $row->dept_designation ? $row->dept_designation->name : '';
            });

            $table->addColumn('reviewed_by_name', function ($row) {
                return $row->reviewed_by ? $row->reviewed_by->name : '';
            });

            $table->addColumn('acknowledge_by_name', function ($row) {
                return $row->acknowledge_by ? $row->acknowledge_by->name : '';
            });
            
            $table->addColumn('result_name', function ($row) {
                return $row->result ? $row->result->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by','result']);
            return $table->make(true);
            
        }
        
        return view('admin.incidentReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('incident_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incidentReports.create', compact('root_causes','dept_designations'));
    }

    public function store(StoreIncidentReportRequest $request)
    {
        $data = $request->all();
    
        // $data['nama_pelapor_id'] = Auth::id();
        $data['nama_pelapor_id'] = auth()->id();   
        $data['team_id'] = Auth::user()->team_id;
        $data['result_id'] = 1;
        // dd($data);

        $incidentReport = IncidentReport::create($data);

        return redirect()->route('admin.incident-reports.index');
    }

    public function edit(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('incident_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team');

        return view('admin.incidentReports.edit', compact('root_causes', 'incidentReport'));
    }

    public function update(UpdateIncidentReportRequest $request, IncidentReport $incidentReport)
    {
        $incidentReport->update($request->all());

        return redirect()->route('admin.incident-reports.index');
    }

    public function show(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('incident_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team');

        return view('admin.incidentReports.show', compact('incidentReport'));
    }

    public function destroy(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('incident_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidentReportRequest $request)
    {
        IncidentReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}
