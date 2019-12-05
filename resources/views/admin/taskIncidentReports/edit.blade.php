@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.taskIncidentReport.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.incident-reports.update", [$incidentReport->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.taskIncidentReport.fields.location') }}*</label>
                            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', isset($incidentReport) ? $incidentReport->location : '') }}" required>
                            @if($errors->has('location'))
                                <p class="help-block">
                                    {{ $errors->first('location') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.taskIncidentReport.fields.location_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('date_incident') ? 'has-error' : '' }}">
                            <label for="date_incident">{{ trans('cruds.taskIncidentReport.fields.date_incident') }}*</label>
                            <input type="text" id="date_incident" name="date_incident" class="form-control datetime" value="{{ old('date_incident', isset($incidentReport) ? $incidentReport->date_incident : '') }}" required>
                            @if($errors->has('date_incident'))
                                <p class="help-block">
                                    {{ $errors->first('date_incident') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.taskIncidentReport.fields.date_incident_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('root_cause_id') ? 'has-error' : '' }}">
                            <label for="root_cause">{{ trans('cruds.taskIncidentReport.fields.root_cause') }}*</label>
                            <select name="root_cause_id" id="root_cause" class="form-control select2" required>
                                @foreach($root_causes as $id => $root_cause)
                                    <option value="{{ $id }}" {{ (isset($incidentReport) && $incidentReport->root_cause ? $incidentReport->root_cause->id : old('root_cause_id')) == $id ? 'selected' : '' }}>{{ $root_cause }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('root_cause_id'))
                                <p class="help-block">
                                    {{ $errors->first('root_cause_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('perbaikan') ? 'has-error' : '' }}">
                            <label for="perbaikan">{{ trans('cruds.taskIncidentReport.fields.perbaikan') }}*</label>
                            <input type="text" id="perbaikan" name="perbaikan" class="form-control" value="{{ old('perbaikan', isset($incidentReport) ? $incidentReport->perbaikan : '') }}" required>
                            @if($errors->has('perbaikan'))
                                <p class="help-block">
                                    {{ $errors->first('perbaikan') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.taskIncidentReport.fields.perbaikan_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('pencegahan') ? 'has-error' : '' }}">
                            <label for="pencegahan">{{ trans('cruds.taskIncidentReport.fields.pencegahan') }}*</label>
                            <input type="text" id="pencegahan" name="pencegahan" class="form-control" value="{{ old('pencegahan', isset($incidentReport) ? $incidentReport->pencegahan : '') }}" required>
                            @if($errors->has('pencegahan'))
                                <p class="help-block">
                                    {{ $errors->first('pencegahan') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.taskIncidentReport.fields.pencegahan_helper') }}
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