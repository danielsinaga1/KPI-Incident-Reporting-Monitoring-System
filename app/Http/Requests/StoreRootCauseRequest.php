<?php

namespace App\Http\Requests;

use App\RootCause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRootCauseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('root_cause_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'root_cause' => [
                'required',
            ],
        ];
    }
}
