<?php

namespace App\Http\Requests;

use App\ClassificationIncident;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreClassificationIncidentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('classification_incident_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'        => [
                'required',
            ],
            'code'        => [
                'required',
            ],
        ];
    }
}
