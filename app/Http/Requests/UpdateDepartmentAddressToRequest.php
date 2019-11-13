<?php

namespace App\Http\Requests;

use App\DepartmentAddressTo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDepartmentAddressToRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('department_address_to_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'cc_code'           => [
                'required',
            ],
            'dept_name_address' => [
                'required',
            ],
        ];
    }
}
