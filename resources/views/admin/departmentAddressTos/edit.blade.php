@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.departmentAddressTo.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.department-address-tos.update", [$departmentAddressTo->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('cc_code') ? 'has-error' : '' }}">
                            <label for="cc_code">{{ trans('cruds.departmentAddressTo.fields.cc_code') }}*</label>
                            <input type="text" id="cc_code" name="cc_code" class="form-control" value="{{ old('cc_code', isset($departmentAddressTo) ? $departmentAddressTo->cc_code : '') }}" required>
                            @if($errors->has('cc_code'))
                                <p class="help-block">
                                    {{ $errors->first('cc_code') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.departmentAddressTo.fields.cc_code_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('dept_name_address') ? 'has-error' : '' }}">
                            <label for="dept_name_address">{{ trans('cruds.departmentAddressTo.fields.dept_name_address') }}*</label>
                            <input type="text" id="dept_name_address" name="dept_name_address" class="form-control" value="{{ old('dept_name_address', isset($departmentAddressTo) ? $departmentAddressTo->dept_name_address : '') }}" required>
                            @if($errors->has('dept_name_address'))
                                <p class="help-block">
                                    {{ $errors->first('dept_name_address') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.departmentAddressTo.fields.dept_name_address_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection