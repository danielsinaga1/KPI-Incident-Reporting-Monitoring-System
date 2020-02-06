<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyTaskIncidentReportRequest;
use App\Http\Requests\StoreTaskIncidentReportRequest;
use App\Http\Requests\UpdateTaskIncidentReportRequest;
use App\IncidentReport;
use App\DesignationDepartment;
use App\RootCause;
use Gate;
use Carbon\Carbon;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Controller;

class TaskIncidentReportController extends Controller
{
    use MediaUploadingTrait;
    public function index(Request $request)
    {
        $authTeamId = auth()->user()->team_id;
        $data2 = IncidentReport::where('dept_designated_id', $authTeamId)->whereNotNull('acknowledge_by_id')->with('dept_designation')->get();
        // dd($request);
        if ($request->ajax()) {
            $query = IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by', 'team']);
            $table = Datatables::of($data2);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'task_incident_report_show';
                $editGate      = 'task_incident_report_edit';
                $deleteGate    = 'task_incident_report_show';
                $crudRoutePart = 'task-incident-reports';

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

            $table->editColumn('no_laporan', function ($row) {
                return $row->no_laporan ? $row->no_laporan : "";
            });

            $table->addColumn('nama_pelapor_name', function ($row) {
                return $row->nama_pelapor ? $row->nama_pelapor->name : '';
            });

            $table->addColumn('dept_origin_name', function ($row) {
                return $row->team ? $row->team->name : '';
            });

            $table->editColumn('photos', function ($row) {
                if (!$row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                   
                }
                return implode(' ', $links);
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

            $table->addColumn('action_by_name', function($row) {
                return $row->action_by ? $row->action_by->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'nama_pelapor', 'location', 'dept_origin', 'root_cause', 'photos', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by','result']);
            return $table->make(true);
            
        }
        
        // else if(auth()->user()->isSupervisor()){
        //     $auth_id = auth()->user()->team->id;
        //     dd($auth_id);
        //     if ($request->ajax()) {
        //         $query = IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team']);
        //         $table = Datatables::of($query);
        //         $table->addColumn('placeholder', '&nbsp;');
        //         $table->addColumn('actions', '&nbsp;');
    
        //         $table->editColumn('actions', function ($row) {
        //             $viewGate      = 'task_incident_report_show';
        //             $editGate      = 'task_incident_report_edit';
        //             $deleteGate    = 'task_incident_report_delete';
        //             $crudRoutePart = 'task-incident-reports';
    
        //             return view('partials.datatablesActions', compact(
        //                 'viewGate',
        //                 'editGate',
        //                 'deleteGate',
        //                 'crudRoutePart',
        //                 'row'
        //             ));
        //         });
    
        //         $table->editColumn('id', function ($row) {
        //             return $row->id ? $row->id : "";
        //         });
        //         $table->addColumn('nama_pelapor_name', function ($row) {
        //             return $row->nama_pelapor ? $row->nama_pelapor->name : '';
        //         });
    
        //         $table->addColumn('dept_origin_name', function ($row) {
        //             // 
        //             // $data = DB::table('incident_reports')->select('team_id')->where('team_id','=','3')->get();
        //             // $data = DB::table('incident_reports')
        //             // ->join('teams','incident_reports.team_id','=','teams.id')
        //             // ->select('name')->get();
        //             // dd(json_encode($data));
        //             return $row->team ? $row->team->name : '';
        //         });
    
        //         $table->editColumn('location', function ($row) {
        //             return $row->location ? $row->location : "";
        //         });
    
        //         $table->addColumn('root_cause_root_cause', function ($row) {
        //             return $row->root_cause ? $row->root_cause->root_cause : '';
        //         });
    
        //         $table->editColumn('perbaikan', function ($row) {
        //             return $row->perbaikan ? $row->perbaikan : "";
        //         });
        //         $table->editColumn('pencegahan', function ($row) {
        //             return $row->pencegahan ? $row->pencegahan : "";
        //         });
    
        //         $table->addColumn('dept_designation_name', function ($row) {
        //             return $row->dept_designation ? $row->dept_designation->name : '';
        //         });

        //         $table->addColumn('action_by_name', function ($row) {
        //             return $row->action_by ? $row->action_by->name : '';
        //         });

        //         $table->addColumn('reviewed_by_name', function ($row) {
        //             return $row->reviewed_by ? $row->reviewed_by->name : '';
        //         });
    
        //         $table->addColumn('acknowledge_by_name', function ($row) {
        //             return $row->acknowledge_by ? $row->acknowledge_by->name : '';
        //         });
                
        //         $table->addColumn('result_name', function ($row) {
        //             return $row->result ? $row->result->name : '';
        //         });
    
        //         $table->rawColumns(['actions', 'placeholder', 'nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation','action_by', 'reviewed_by', 'acknowledge_by','result']);
        //         return $table->make(true);
                
        //     }
        // }

        return view('admin.taskIncidentReports.index');
    }
    
    public function create()
    {
        abort_if(Gate::denies('task_incident_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taskIncidentReports.create', compact('root_causes','dept_designations'));
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

        //ditest
        if(! $data['team_id'] = $user->team->id){
            $incidentReport->assignToTeam($request['team_id']);                
        }

        return redirect()->route('admin.task-incident-reports.index');
    }

    public function edit(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('task_incident_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team');

        return view('admin.taskIncidentReports.edit', compact('root_causes', 'incidentReport'));
    }

    public function update(UpdateTaskIncidentReportRequest $request, IncidentReport $incidentReport)
    {
        $incidentReport->update($request->all());

        return redirect()->route('admin.task-incident-reports.index');
    }

    public function show(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('task_incident_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by', 'team');
        // dd($incidentReport);
        return view('admin.taskIncidentReports.show', compact('incidentReport'));
    }

    public function destroy(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('task_incident_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskIncidentReportRequest $request)
    {
        IncidentReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    public function getDataForSupervisor(Request $request){
        if ($request->ajax()) {
            $query = IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team']);
            $table = Datatables::of($query);
        }
    }

    public function actionByuser(IncidentReport $incidentReport) {

        $incidentReport->action_by_id = auth()->user()->id;
        $incidentReport->status = "Close";
        $incidentReport->update();
        // $incidentReport->update(['result_id' => 1,
        // 'reviewed_by_id' => auth()->user()->id
        // ]);
        return redirect()->route('admin.task-incident-reports.index');
    }
}
