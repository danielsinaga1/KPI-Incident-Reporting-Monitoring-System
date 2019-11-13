<?php

namespace App\Http\Requests;

use App\IncidentReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateIncidentReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('incident_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'location'      => [
                'required',
            ],
            'date_incident' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'root_cause_id' => [
                'required',
                'integer',
            ],
            'perbaikan'     => [
                'required',
            ],
            'pencegahan'    => [
                'required',
            ],
        ];
    }
}
