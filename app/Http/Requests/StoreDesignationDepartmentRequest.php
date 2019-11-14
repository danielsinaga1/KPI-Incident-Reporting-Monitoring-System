<?php

namespace App\Http\Requests;

use App\DesignationDepartment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDesignationDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('designation_department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'cc_code' => [
                'required',
            ],
            'name' => [
                'required',
            ],
        ];
    }
}
