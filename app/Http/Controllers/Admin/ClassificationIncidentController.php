<?php

namespace App\Http\Controllers\Admin;

use App\ClassificationIncident;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClassificationIncidentRequest;
use App\Http\Requests\StoreClassificationIncidentRequest;
use App\Http\Requests\UpdateClassificationIncidentRequest;
use Gate;
use DB;
use App\IncidentReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassificationIncidentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('classification_incident_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classificationIncidents = ClassificationIncident::all();
        // $dt = $now->year;
        $query1 = DB::table('incident_reports')->join('teams','incident_reports.team_id','=','teams.id')->select('incident_reports.*')->get();        
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
    
        return view('admin.classificationIncidents.index', compact('classificationIncidents'));
    }

    public function create()
    {
        abort_if(Gate::denies('classification_incident_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.classificationIncidents.create');
    }

    public function store(StoreClassificationIncidentRequest $request)
    {
        $classificationIncident = ClassificationIncident::create($request->all());

        return redirect()->route('admin.classification-incidents.index');
    }

    public function edit(ClassificationIncident $classificationIncident)
    {
        abort_if(Gate::denies('classification_incident_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $categoryIncident->load('team');

        return view('admin.classificationIncidents.edit', compact('categoryIncident'));
    }

    public function update(UpdateClassificationIncidentRequest $request, ClassificationIncident $classificationIncident)
    {
        $classificationIncident->update($request->all());

        return redirect()->route('admin.classification-incidents.index');
    }

    public function show(ClassificationIncident $classificationIncident)
    {
        abort_if(Gate::denies('classification_incident_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.classificationIncidents.show', compact('classificationIncident'));
    }

    public function destroy(ClassificationIncident $classificationIncident)
    {
        abort_if(Gate::denies('classification_incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classificationIncident->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassificationIncidentRequest $request)
    {
        ClassificationIncident::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
