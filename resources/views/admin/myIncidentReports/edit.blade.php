@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.myIncidentReport.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.my-incident-reports.update", [$incidentReport->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.myIncidentReport.fields.location') }}*</label>
                            <input type="text" id="location" name="location" class="form-control" value="{{ old('location', isset($incidentReport) ? $incidentReport->location : '') }}" required>
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
                            <label for="date_incident">{{ trans('cruds.myIncidentReport.fields.date_incident') }}*</label>
                            <input type="text" id="date_incident" name="date_incident" class="form-control datetime" value="{{ old('date_incident', isset($incidentReport) ? $incidentReport->date_incident : '') }}" required>
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
                                    <option value="{{ $id }}" {{ (isset($incidentReport) && $incidentReport->root_cause ? $incidentReport->root_cause->id : old('root_cause_id')) == $id ? 'selected' : '' }}>{{ $root_cause }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('root_cause_id'))
                                <p class="help-block">
                                    {{ $errors->first('root_cause_id') }}
                                </p>
                            @endif
                        </div>
                        {{-- <div class="form-group {{ $errors->has('perbaikan') ? 'has-error' : '' }}">
                            <label for="perbaikan">{{ trans('cruds.incidentReport.fields.perbaikan') }}*</label>
                            <input type="text" id="perbaikan" name="perbaikan" class="form-control" value="{{ old('perbaikan', isset($incidentReport) ? $incidentReport->perbaikan : '') }}" required>
                            @if($errors->has('perbaikan'))
                                <p class="help-block">
                                    {{ $errors->first('perbaikan') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.myIncidentReport.fields.perbaikan_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('pencegahan') ? 'has-error' : '' }}">
                            <label for="pencegahan">{{ trans('cruds.myIncidentReport.fields.pencegahan') }}*</label>
                            <input type="text" id="pencegahan" name="pencegahan" class="form-control" value="{{ old('pencegahan', isset($incidentReport) ? $incidentReport->pencegahan : '') }}" required>
                            @if($errors->has('pencegahan'))
                                <p class="help-block">
                                    {{ $errors->first('pencegahan') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.myIncidentReport.fields.pencegahan_helper') }}
                            </p>
                        </div> --}}
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
    maxFilesize: 2, // MB
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
          var files =
            {!! json_encode($incidentReport->photos) !!}
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