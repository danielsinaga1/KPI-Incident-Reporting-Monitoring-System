<?php

namespace App\Http\Requests;

use App\CategoryIncident;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCategoryIncidentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('category_incident_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'type'        => [
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
