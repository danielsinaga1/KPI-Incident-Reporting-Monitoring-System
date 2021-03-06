@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.department.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.teams.update", [$team->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('cc_code') ? 'has-error' : '' }}">
                            <label for="cc_code">{{ trans('cruds.department.fields.cc_code') }}*</label>
                            <input type="text" id="cc_code" name="cc_code" class="form-control" value="{{ old('cc_code', isset($team) ? $team->cc_code : '') }}" required>
                            @if($errors->has('cc_code'))
                                <p class="help-block">
                                    {{ $errors->first('cc_code') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.department.fields.cc_code_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.department.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($team) ? $team->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.department.fields.name_helper') }}
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