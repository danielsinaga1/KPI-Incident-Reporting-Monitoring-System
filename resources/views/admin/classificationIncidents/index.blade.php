@extends('layouts.admin')
@section('content')
<div class="content">
    @can('classification_incident_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.classification-incidents.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.classificationIncident.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.classificationIncident.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ClassificationIncident">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.type') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classificationIncidents as $key => $classificationIncident)
                                    <tr data-entry-id="{{ $classificationIncident->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $classificationIncident->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $classificationIncident->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $classificationIncident->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $classificationIncident->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $classificationIncident->description ?? '' }}
                                        </td>
                                        <td>
                                            @can('classification_incident_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.classification-incidents.show', $classificationIncident->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('classification_incident_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.classification-incidents.edit', $classificationIncident->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('classification_incident_delete')
                                                <form action="{{ route('admin.classification-incidents.destroy', $classificationIncident->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('classification_incident_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.classification-incidents.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  $('.datatable-ClassificationIncident:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection