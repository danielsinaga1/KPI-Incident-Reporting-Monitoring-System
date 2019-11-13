@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.assets.update", [$asset->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label for="category">{{ trans('cruds.asset.fields.category') }}*</label>
                            <select name="category_id" id="category" class="form-control select2" required>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (isset($asset) && $asset->category ? $asset->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <p class="help-block">
                                    {{ $errors->first('category_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('serial_number') ? 'has-error' : '' }}">
                            <label for="serial_number">{{ trans('cruds.asset.fields.serial_number') }}</label>
                            <input type="text" id="serial_number" name="serial_number" class="form-control" value="{{ old('serial_number', isset($asset) ? $asset->serial_number : '') }}">
                            @if($errors->has('serial_number'))
                                <p class="help-block">
                                    {{ $errors->first('serial_number') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.serial_number_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.asset.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($asset) ? $asset->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('photos') ? 'has-error' : '' }}">
                            <label for="photos">{{ trans('cruds.asset.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">

                            </div>
                            @if($errors->has('photos'))
                                <p class="help-block">
                                    {{ $errors->first('photos') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.photos_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                            <label for="status">{{ trans('cruds.asset.fields.status') }}*</label>
                            <select name="status_id" id="status" class="form-control select2" required>
                                @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ (isset($asset) && $asset->status ? $asset->status->id : old('status_id')) == $id ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status_id'))
                                <p class="help-block">
                                    {{ $errors->first('status_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('location_id') ? 'has-error' : '' }}">
                            <label for="location">{{ trans('cruds.asset.fields.location') }}*</label>
                            <select name="location_id" id="location" class="form-control select2" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ (isset($asset) && $asset->location ? $asset->location->id : old('location_id')) == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location_id'))
                                <p class="help-block">
                                    {{ $errors->first('location_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                            <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                            <textarea id="notes" name="notes" class="form-control ">{{ old('notes', isset($asset) ? $asset->notes : '') }}</textarea>
                            @if($errors->has('notes'))
                                <p class="help-block">
                                    {{ $errors->first('notes') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.asset.fields.notes_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('assigned_to_id') ? 'has-error' : '' }}">
                            <label for="assigned_to">{{ trans('cruds.asset.fields.assigned_to') }}</label>
                            <select name="assigned_to_id" id="assigned_to" class="form-control select2">
                                @foreach($assigned_tos as $id => $assigned_to)
                                    <option value="{{ $id }}" {{ (isset($asset) && $asset->assigned_to ? $asset->assigned_to->id : old('assigned_to_id')) == $id ? 'selected' : '' }}>{{ $assigned_to }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_to_id'))
                                <p class="help-block">
                                    {{ $errors->first('assigned_to_id') }}
                                </p>
                            @endif
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
    url: '{{ route('admin.assets.storeMedia') }}',
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
@if(isset($asset) && $asset->photos)
          var files =
            {!! json_encode($asset->photos) !!}
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
@stop