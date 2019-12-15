<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMyIncidentReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('my_incident_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
            // 'perbaikan'     => [
            //     'required',
            // ],
            // 'pencegahan'    => [
            //     'required',
            // ],
        ];
    }
}
