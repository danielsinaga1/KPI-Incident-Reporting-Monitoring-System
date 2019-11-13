@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.categoryIncident.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.category-incidents.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.categoryIncident.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($categoryIncident) ? $categoryIncident->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.categoryIncident.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                            <label for="code">{{ trans('cruds.categoryIncident.fields.code') }}*</label>
                            <input type="text" id="code" name="code" class="form-control" value="{{ old('code', isset($categoryIncident) ? $categoryIncident->code : '') }}" required>
                            @if($errors->has('code'))
                                <p class="help-block">
                                    {{ $errors->first('code') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.categoryIncident.fields.code_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type">{{ trans('cruds.categoryIncident.fields.type') }}*</label>
                            <input type="text" id="type" name="type" class="form-control" value="{{ old('type', isset($categoryIncident) ? $categoryIncident->type : '') }}" required>
                            @if($errors->has('type'))
                                <p class="help-block">
                                    {{ $errors->first('type') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.categoryIncident.fields.type_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.categoryIncident.fields.description') }}*</label>
                            <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($categoryIncident) ? $categoryIncident->description : '') }}</textarea>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.categoryIncident.fields.description_helper') }}
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