@extends('layouts.admin')
@section('content')
<div class="content">
    @can('incident_report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.incident-reports.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.taskIncidentReport.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.taskIncidentReport.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IncidentReport">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.nama_pelapor') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.dept_origin') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.location') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.date_incident') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.root_cause') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.perbaikan') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.pencegahan') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.result') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.date_dept_action') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.dept_designation') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.reviewed_by') }}
                                </th>
                                <th>
                                    {{ trans('cruds.taskIncidentReport.fields.acknowledge_by') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                       </table>
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
@can('incident_report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.incident-reports.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.incident-reports.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'nama_pelapor_name', name: 'nama_pelapor.name' },
      { data: 'dept_origin_name'},
      { data: 'location', name: 'location' },
      { data: 'date_incident', name: 'date_incident' },
      { data: 'root_cause_root_cause', name: 'root_cause.root_cause' },
      { data: 'perbaikan', name: 'perbaikan' },
      { data: 'pencegahan', name: 'pencegahan' },
      { data: 'result_name', name: 'result.name' },
      { data: 'date_dept_action', name: 'date_dept_action' },
      { data: 'dept_designation_name', name: 'dept_designation.name' },
      { data: 'reviewed_by_name', name: 'reviewed_by.name' },
      { data: 'acknowledge_by_name', name: 'acknowledge_by.name' },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  };  

  $('.datatable-IncidentReport').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection