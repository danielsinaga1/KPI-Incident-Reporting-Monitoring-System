<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyIncidentReportRequest;
use App\Http\Requests\StoreIncidentReportRequest;
use App\Http\Requests\UpdateMyIncidentReportRequest;
use App\IncidentReport;
use App\DesignationDepartment;
use App\RootCause;
use App\CategoryIncident;
use App\ClassificationIncident;
use Gate;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MyIncidentReportController extends Controller
{
    use MediaUploadingTrait;
    
    public function index(Request $request)
    {
        $authTeamId = auth()->user()->team_id;
        $query1 = DB::table('incident_reports')
        ->join('users', 'incident_reports.team_id' ,'=','users.team_id')
        ->where('users.team_id','=',$authTeamId)->select('incident_reports.*')->get();

        $query3 = DB::table('incident_reports')
        ->join('users','incident_reports.team_id', '=', 'users.team_id')
        ->where('users.team_id', '=', $authTeamId)
        ->where('result_id','=','2')
        ->whereNotNull('acknowledge_by_id')
        ->select('incident_reports.*')->get();

        $now = Carbon::now();

        $from = DB::table('incident_reports')->
                where('id','1')->select('created_at')->get();

        $to = Carbon::createFromFormat('Y-m-d H:i:s',$now);

        $date1 = strtotime($from);  
        $date2 = strtotime($now);  
        $diff = abs($date2 - $date1);  
        // To get the year divide the resultant date into 
        // total seconds in a year (365*60*60*24) 
        $years = floor($diff / (365*60*60*24));  
          
        // To get the month, subtract it with years and 
        // divide the resultant date into 
        // total seconds in a month (30*60*60*24) 
        $months = floor(($diff - $years * 365*60*60*24) 
        / (30*60*60*24));  
        // Formulate the Difference between two dates 

        $days = floor(($diff - $years * 365*60*60*24 -  
             $months*30*60*60*24)/ (60*60*24)); 
        

        dd($days);


        if($days > 3){
         echo('Sudah lebih woi');
        }
        $query1 = DB::table('incident_reports')
        ->join('users', 'incident_reports.team_id' ,'=','users.team_id')
        ->where('users.team_id','=',$authTeamId)->select('incident_reports.*')->get();

        // $load2 = IncidentReport::where('team_id', $authTeamId)->where('nama_pelapor')->with(['team','user'])->get();

        $load = IncidentReport::where('team_id', $authTeamId)->with('team')->get();

        $load2 = IncidentReport::where('team_id', $authTeamId)->where('result_id', 1)->with('dept_origin')->get();

        $load3 = IncidentReport::where('team_id', $authTeamId)->where('result_id', 1)->whereNotNull('acknowledge_by_id')->with('dept_origin')->get();

         // $baca = IncidentReport::with(['team' => function($query) use ($authTeamId) {
                //     $query->where('team_id', $authTeamId);
                //     }])->get();

        // $nameID = $incidentReport->nama_pelapor()->name;

        if(auth()->user()->isSupervisor()) {

            if($request->ajax()) {
                
                  $data2 = IncidentReport::where('team_id', $authTeamId)->with('dept_origin')->get();
                  $table = DataTables::of($data2);
                  $table->addColumn('placeholder', '&nbsp;');
                  $table->addColumn('actions', '&nbsp;');

                  $table->editColumn('actions', function ($row) {
                    $viewGate      = 'my_incident_report_show';
                    $editGate      = 'my_incident_report_edit';
                    $deleteGate    = 'my_incident_report_delete';
                    $crudRoutePart = 'my-incident-reports';
    
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
    
                $table->editColumn('location', function ($row) {
                    return $row->location ? $row->location : "";
                });

                $table->addColumn('category_incident_name', function ($row) {
                    return $row->category_incident ? $row->category_incident->name : '';
                  });
    
                  $table->addColumn('classify_incident_name', function ($row) {
                    return $row->classify_incident ? $row->classify_incident->name : '';
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
    
                $table->addColumn('action_by_name', function ($row) {
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

                $table->addColumn('status', function ($row) {
                    return $row->status ? $row->status : "";
                });
    
                $table->rawColumns(['actions', 'placeholder', 'nama_pelapor', 'location', 'dept_origin', 'root_cause', 'photos', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by','result','category_incident','classify_incident']);
                return $table->make(true);
            }
        }
        
        elseif(auth()->user()->isManager()) {
            if($request->ajax()) {
                $data3 = IncidentReport::where('team_id', $authTeamId)->where('result_id', 1)->whereNotNull('reviewed_by_id')->with('dept_origin')->get();
                $table = DataTables::of($data3);
                $table->addColumn('placeholder', '&nbsp;');
                $table->addColumn('actions', '&nbsp;');

                $table->editColumn('actions', function ($row) {
                  $viewGate      = 'my_incident_report_show';
                  $editGate      = 'my_incident_report_edit';
                  $deleteGate    = 'my_incident_report_delete';
                  $crudRoutePart = 'my-incident-reports';
  
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
  
              $table->editColumn('location', function ($row) {
                  return $row->location ? $row->location : "";
              });
              
              $table->addColumn('category_incident_name', function ($row) {
                return $row->category_incident ? $row->category_incident->name : '';
              });

              $table->addColumn('classify_incident_name', function ($row) {
                return $row->classify_incident ? $row->classify_incident->name : '';
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
  
              $table->addColumn('action_by_name', function ($row) {
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
              $table->addColumn('status', function ($row) {
                return $row->status ? $row->status : "";
            });
  
              $table->rawColumns(['actions', 'placeholder', 'nama_pelapor', 'location', 'dept_origin', 'root_cause', 'photos', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by','result','category_incident','classify_incident']);
              return $table->make(true);
          }
        }
        // if(auth()->isSupervisor() && auth()->user()->team_id == $incidentReport->name_pelapor->id)
        // $query1 = DB::table('incident_reports')
        //           ->join('teams', $authTeamId ,'=','teams.id')->select('incident_reports.*','teams.name')->where('result','=',3)->get();

        
        // dd($query1);

           elseif ($request->ajax()) {
                $query = IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by', 'team']);
                $table = Datatables::of($query);
                $table->addColumn('placeholder', '&nbsp;');
                $table->addColumn('actions', '&nbsp;');
    
                $table->editColumn('actions', function ($row) {
                    $viewGate      = 'my_incident_report_show';
                    $editGate      = 'my_incident_report_edit';
                    $deleteGate    = 'my_incident_report_delete';
                    $crudRoutePart = 'my-incident-reports';
    
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
    
                $table->editColumn('location', function ($row) {
                    return $row->location ? $row->location : "";
                });

                $table->addColumn('category_incident_name', function ($row) {
                    return $row->category_incident ? $row->category_incident->name : '';
                  });
    
                  $table->addColumn('classify_incident_name', function ($row) {
                    return $row->classify_incident ? $row->classify_incident->name : '';
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
    
                $table->addColumn('action_by_name', function ($row) {
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

                $table->addColumn('status', function ($row) {
                    return $row->status ? $row->status : "";
                });
                $table->rawColumns(['actions', 'placeholder','nama_pelapor', 'location', 'dept_origin', 'root_cause', 'photos', 'dept_designation', 'action_by', 'reviewed_by', 'acknowledge_by','result','category_incident','classify_incident']);
                return $table->make(true);
                
            }

        return view('admin.myIncidentReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('my_incident_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');
        $category_incidents = CategoryIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $classification_incidents = ClassificationIncident::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        return view('admin.myIncidentReports.create', compact('root_causes','dept_designations','category_incidents','classification_incidents'));
    }

    public function store(StoreIncidentReportRequest $request)
    {
        $data = $request->all();
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        
        $nextNumberReport = "LI-". $month . $year . "-" . IncidentReport::getNextNumberReport();
        // $data['nama_pelapor_id'] = Auth::id();
        $data['nama_pelapor_id'] = auth()->id();   
        $data['team_id'] = Auth::user()->team_id;
        $data['result_id'] = 3;
        $data['status'] = 'Open';
        $data['no_laporan'] = $nextNumberReport;
        $incidentReport = IncidentReport::create($data);
      
        foreach ($request->input('photos', []) as $file) {
            $incidentReport->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }
      
        // foreach ($request->input('gallery'. []) as $file) {
        //     $incidentReport->addMedia(storage_path('tmp/uploads' . $file))->toMediaCollection('gallery'); 
        // }

        // //ditest
        // if(! $data['team_id'] = $user->team->id){
        //     $incidentReport->assignToTeam($request['team_id']);                
        // }

        return redirect()->route('admin.my-incident-reports.index');
    }

    public function edit(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('my_incident_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dept_designations = DesignationDepartment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $root_causes = RootCause::all()->pluck('root_cause', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'action_by','reviewed_by', 'acknowledge_by', 'team');

        return view('admin.MyIncidentReports.edit', compact('root_causes', 'incidentReport'));
    }

    public function update(UpdateMyIncidentReportRequest $request, IncidentReport $incidentReport)
    {
        $incidentReport->update($request->all());
        
        if (count($incidentReport->photos) > 0) {
            foreach ($incidentReport->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $incidentReport->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $incidentReport->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.my-incident-reports.index');
    }

    public function show(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('my_incident_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->load('nama_pelapor', 'dept_origin', 'root_cause', 'dept_designation', 'reviewed_by', 'acknowledge_by', 'team');
        // dd($incidentReport->id);
        return view('admin.myIncidentReports.show', compact('incidentReport'));
    }

    public function destroy(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('my_incident_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidentReportRequest $request)
    {
        IncidentReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    public function approve($incidentReport_id) {
        
        $incidentReport = IncidentReport::findOrFail($incidentReport_id);

        if($incidentReport) {
            $incidentReport->update(['result_id' => 1,
                                     'reviewed_by_id' => auth()->user()->id
                                     ]);
            // $incidentReport->save();
            return redirect()->route('admin.my-incident-reports.index');
        }
    }

    public function approveByAjax(Request $request, $id) {
        $incidentReport = new IncidentReport();
        
        $dataId = IncidentReport::findOrFail($id);
        if($dataId) {
            $incidentReport->result_id = 1;
            $incidentReport->reviewed_by_id = auth()->user()->id;
            $incidentReport->update();
        }
     
        // return response()->json($data);
        return redirect()->route('admin.my-incident-reports.index');
    }

    public function approveByManager(IncidentReport $incidentReport) {

        $data = IncidentReport::whereNotNull('reviewed_by_id')->get();

        if($data) {
            $incidentReport->acknowledge_by_id = auth()->user()->id;
            $incidentReport->update();
        }
       
    return redirect()->route('admin.my-incident-reports.index');
        
    }
    
    public function approveByAdmin(IncidentReport $incidentReport) {

            $incidentReport->result_id = 1;
            $incidentReport->reviewed_by_id = auth()->user()->id;
            $incidentReport->update();
            // $incidentReport->update(['result_id' => 1,
            // 'reviewed_by_id' => auth()->user()->id
            // ]);
            return redirect()->route('admin.my-incident-reports.index');
    }

    public function reject(Request $request, $id) {
        $incidentReport = IncidentReport::find($id);

        if($incidentReport) {
            $incidentReport->result_id = 2;
            $incidentReport->save();
            return redirect()->route('admin.my-incident-reports.index');
            
        }
    }
}
