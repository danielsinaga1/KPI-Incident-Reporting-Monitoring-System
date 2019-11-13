@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.rootCause.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.root-causes.update", [$rootCause->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('root_cause') ? 'has-error' : '' }}">
                            <label for="root_cause">{{ trans('cruds.rootCause.fields.root_cause') }}*</label>
                            <input type="text" id="root_cause" name="root_cause" class="form-control" value="{{ old('root_cause', isset($rootCause) ? $rootCause->root_cause : '') }}" required>
                            @if($errors->has('root_cause'))
                                <p class="help-block">
                                    {{ $errors->first('root_cause') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.rootCause.fields.root_cause_helper') }}
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