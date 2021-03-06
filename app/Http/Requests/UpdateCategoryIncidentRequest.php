<?php

namespace App\Http\Requests;

use App\CategoryIncident;
use Gate;
use Illuminate\Foundation\Http\FosmRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCategoryIncidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('category_incident_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            'name'        => [
                'required',
            ],

        ];
    }
}
