@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.classificationDetail.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.classification-details.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="classifyIncidents">{{ trans('cruds.classificationDetail.fields.name') }}*</label>
                            <select name="classify_id" id="classify" class="form-control select2" required>
                                @foreach($classifyIncidents as $id => $classifyIncident)
                                    <option value="{{ $id }}" {{ (isset($classificationDetail) && $classificationDetail->classify_incident ? $classificationDetail->classify_incident->id : old('classify_id')) == $id ? 'selected' : '' }}>{{ $classifyIncident }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('classify_id'))
                                <p class="help-block">
                                    {{ $errors->first('classify_id') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.classificationDetail.fields.name_helper') }}
                            </p>
                        </div>

                        <div class="form-group {{ $errors->has('cat_id') ? 'has-error' : '' }}">
                            <label for="categoryIncidents">{{ trans('cruds.classificationDetail.fields.category') }}*</label>
                            <select name="cat_id" id="category" class="form-control select2" required>
                                @foreach($categoryIncidents as $id => $categoryIncident)
                                    <option value="{{ $id }}" {{ (isset($classificationDetail) && $classificationDetail->category_incident ? $classificationDetail->category_incident->id : old('cat_id')) == $id ? 'selected' : '' }}>{{ $categoryIncident }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cat_id'))
                                <p class="help-block">
                                    {{ $errors->first('cat_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.classificationDetail.fields.description') }}*</label>
                            <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($classificationDetail) ? $classificationDetail->description : '') }}</textarea>
                            @if($errors->has('description'))
                                <p class="help-block">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.classificationDetail.fields.description_helper') }}
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