<?php

namespace App\Http\Requests;

use App\IncidentReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIncidentReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('incident_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:incident_reports,id',
        ];
    }
}
