<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidentReportRequest;
use App\Http\Requests\UpdateIncidentReportRequest;
use App\Http\Resources\Admin\IncidentReportResource;
use App\IncidentReport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidentReportsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incident_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentReportResource(IncidentReport::with(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_addressed_to', 'reviewed_by', 'acknowledge_by', 'team'])->get());
    }

    public function store(StoreIncidentReportRequest $request)
    {
        $incidentReport = IncidentReport::create($request->all());

        return (new IncidentReportResource($incidentReport))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('incident_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentReportResource($incidentReport->load(['nama_pelapor', 'dept_origin', 'root_cause', 'dept_addressed_to', 'reviewed_by', 'acknowledge_by', 'team']));
    }

    public function update(UpdateIncidentReportRequest $request, IncidentReport $incidentReport)
    {
        $incidentReport->update($request->all());

        return (new IncidentReportResource($incidentReport))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IncidentReport $incidentReport)
    {
        abort_if(Gate::denies('incident_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentReport->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
