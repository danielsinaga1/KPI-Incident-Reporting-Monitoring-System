@extends('layouts.admin')
@section('content')
<div class="content">
    @can('my_incident_report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.my-incident-reports.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.incidentReport.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.myIncidentReport.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MyIncidentReport">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.id') }}
                                </th>
                                
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.no_laporan') }}
                                </th>

                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.nama_pelapor') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.dept_origin') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.location') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.category') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.classification') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.photos') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.date_incident') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.root_cause') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.perbaikan') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.pencegahan') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.result') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.status') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.date_dept_action') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.dept_designation') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.action_by') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.reviewed_by') }}
                                </th>
                                <th>
                                    {{ trans('cruds.myIncidentReport.fields.acknowledge_by') }}
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
@can('my_incident_report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-incident-reports.massDestroy') }}",
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
    ajax: "{{ route('admin.my-incident-reports.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'no_laporan', name: 'no_laporan' },
      { data: 'nama_pelapor_name', name: 'nama_pelapor.name' },
      { data: 'dept_origin_name'},
      { data: 'location', name: 'location' },
      { data: 'category_incident_name', name: 'category_incident.name' },
      { data: 'classify_incident_name', name: 'classify_incident.name' },
      { data: 'photos', name: 'photos', sortable: false, searchable: false },
      { data: 'date_incident', name: 'date_incident' },
      { data: 'root_cause_root_cause', name: 'root_cause.root_cause' },
      { data: 'perbaikan', name: 'perbaikan' },
      { data: 'pencegahan', name: 'pencegahan' },
      { data: 'result_name', name: 'result.name' },
      { data: 'status', name: 'status' },
      { data: 'date_dept_action', name: 'date_dept_action' },
      { data: 'dept_designation_name', name: 'dept_designation.name' },
      { data: 'action_by_name', name: 'action_by.name' },
      { data: 'reviewed_by_name', name: 'reviewed_by.name' },
      { data: 'acknowledge_by_name', name: 'acknowledge_by.name' },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  };  

  $('.datatable-MyIncidentReport').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('.datatable-MyIncidentReport').on("click", "th.select-checkbox", function() {
            if ($("th.select-checkbox").hasClass("selected")) {
                datatable.rows().deselect();
             $("th.select-checkbox").removeClass("selected");
             } else {
                datatable.rows().select();
             $("th.select-checkbox").addClass("selected");
            }
        }).on("select deselect", function() {
            ("Some selection or deselection going on")
             if (datatable.rows({
                  selected: true
             }).count() !== datatable.rows().count()) {
              $("th.select-checkbox").removeClass("selected");
            } else {
             $("th.select-checkbox").addClass("selected");
         }
});    
});

</script>
@endsection