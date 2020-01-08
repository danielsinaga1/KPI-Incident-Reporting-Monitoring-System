@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.myIncidentReport.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.my-incident-reports.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.myIncidentReport.fields.location') }}*</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location', isset($incidentReport) ? $incidentReport->location : '') }}"
                                required>
                            @if($errors->has('location'))
                            <p class="help-block">
                                {{ $errors->first('location') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.myIncidentReport.fields.location_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('date_incident') ? 'has-error' : '' }}">
                            <label
                                for="date_incident">{{ trans('cruds.myIncidentReport.fields.date_incident') }}*</label>
                            <input type="text" id="date_incident" name="date_incident" class="form-control datetime"
                                value="{{ old('date_incident', isset($incidentReport) ? $incidentReport->date_incident : '') }}"
                                required>
                            @if($errors->has('date_incident'))
                            <p class="help-block">
                                {{ $errors->first('date_incident') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.myIncidentReport.fields.date_incident_helper') }}
                            </p>
                        </div>

                        <div class="form-group {{ $errors->has('photos') ? 'has-error' : '' }}">
                            <label for="photos">{{ trans('cruds.myIncidentReport.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">

                            </div>
                            @if($errors->has('photos'))
                            <span class="help-block" role="alert">{{ $errors->first('photos') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.myIncidentReport.fields.photos_helper') }}</span>
                        </div>

                        <div class="form-group {{ $errors->has('root_cause_id') ? 'has-error' : '' }}">
                            <label for="root_cause">{{ trans('cruds.myIncidentReport.fields.root_cause') }}*</label>
                            <select name="root_cause_id" id="root_cause" class="form-control select2" required>
                                @foreach($root_causes as $id => $root_cause)
                                <option value="{{ $id }}"
                                    {{ (isset($incidentReport) && $incidentReport->root_cause ? $incidentReport->root_cause->id : old('root_cause_id')) == $id ? 'selected' : '' }}>
                                    {{ $root_cause }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('root_cause_id'))
                            <p class="help-block">
                                {{ $errors->first('root_cause_id') }}
                            </p>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('dept_designated_id') ? 'has-error' : '' }}">
                            <label
                                for="dept_designation">{{ trans('cruds.myIncidentReport.fields.dept_designation') }}*</label>
                            <select name="dept_designated_id" id="dept_designation" class="form-control select2"
                                required>
                                @foreach($dept_designations as $id => $dept_designation)
                                <option value="{{ $id }}"
                                    {{ (isset($incidentReport) && $incidentReport->dept_designation ? $incidentReport->dept_designation->id : old('dept_designated_id')) == $id ? 'selected' : '' }}>
                                    {{ $dept_designation }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('dept_designated_id'))
                            <p class="help-block">
                                {{ $errors->first('dept_designated_id') }}
                            </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('cat_id') ? 'has-error' : '' }}">
                            <label for="category">{{ trans('cruds.myIncidentReport.fields.category') }}*</label>
                            <select name="cat_id" id="category" class="form-control select2" required>
                                @foreach($category_incidents as $id => $category)
                                <option value="{{ $id }}"
                                    {{ (isset($incidentReport) && $incidentReport->category_incident ? $incidentReport->category_incident->id : old('cat_id')) == $id ? 'selected' : '' }}>
                                    {{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cat_id'))
                            <p class="help-block">
                                {{ $errors->first('cat_id') }}
                            </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('classify_id') ? 'has-error' : '' }}">
                            <label for="classification">{{ trans('cruds.myIncidentReport.fields.classification') }}*</label>
                            <select name="classify_id" id="classification" class="form-control select2" required>
                                @foreach($classification_incidents as $id => $classification)
                                <option value="{{ $id }}"
                                    {{ (isset($incidentReport) && $incidentReport->classify_incident ? $incidentReport->classify_incident->id : old('classify_id')) == $id ? 'selected' : '' }}>
                                    {{ $classification }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cat_id'))
                            <p class="help-block">
                                {{ $errors->first('cat_id') }}
                            </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.myIncidentReport.fields.description') }}*</label>
                            <input type="text" id="description" name="description" class="form-control"
                                value="{{ old('description', isset($incidentReport) ? $incidentReport->description : '') }}"
                                required>
                            @if($errors->has('description'))
                            <p class="help-block">
                                {{ $errors->first('description') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.myIncidentReport.fields.description_helper') }}
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

@section('scripts')
<script>
    var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
        url: '{{ route('admin.my-incident-reports.storeMedia') }}',
        maxFilesize: 4, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 2
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
            uploadedPhotosMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedPhotosMap[file.name]
            }
            $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($incidentReport) && $incidentReport->photos)
            var files = { !!json_encode($incidentReport->photos) !!}

            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
            }
    @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection
{{-- <script>
    var uploadedUploadFileMap = {}
Dropzone.options.uploadFileDropzone = {
    url: '{{ route('admin.my-incident-reports.storeMedia') }}',
maxFilesize: 10, // MB
addRemoveLinks: true,
headers: {
'X-CSRF-TOKEN': "{{ csrf_token() }}"
},
params: {
size: 10
},
success: function (file, response) {
$('form').append('<input type="hidden" name="upload_file[]" value="' + response.name + '">')
uploadedUploadFileMap[file.name] = response.name
},
removedfile: function (file) {
file.previewElement.remove()
var name = ''
if (typeof file.file_name !== 'undefined') {
name = file.file_name
} else {
name = uploadedUploadFileMap[file.name]
}
$('form').find('input[name="upload_file[]"][value="' + name + '"]').remove()
},
init: function () {
@if(isset($incidentReport) && $incidentReport->upload_file)
var files =
{!! json_encode($incidentReport->upload_file) !!}
for (var i in files) {
var file = files[i]
this.options.addedfile.call(this, file)
file.previewElement.classList.add('dz-complete')
$('form').append('<input type="hidden" name="upload_file[]" value="' + file.file_name + '">')
}
@endif
},
error: function (file, response) {
if ($.type(response) === 'string') {
var message = response //dropzone sends it's own error messages in string
} else {
var message = response.errors.file
}
file.previewElement.classList.add('dz-error')
_ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
_results = []
for (_i = 0, _len = _ref.length; _i < _len; _i++) { node=_ref[_i] _results.push(node.textContent=message) } return
    _results } } </script> --}} {{-- @endsection --}}