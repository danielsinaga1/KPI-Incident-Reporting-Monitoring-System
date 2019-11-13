<?php

namespace App\Http\Requests;

use App\DepartmentAddressTo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepartmentAddressToRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('department_address_to_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:department_address_tos,id',
        ];
    }
}
