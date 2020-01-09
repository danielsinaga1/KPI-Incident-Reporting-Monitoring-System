@extends('layouts.admin')
@section('content')
<div class="content">
    @can('root_cause_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.root-causes.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.auditLog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.auditLog.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-RootCause">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.subject_id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.subject_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.user_id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.host') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.auditLog.fields.created_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditLogs as $key => $auditLog)
                                    <tr data-entry-id="{{ $auditLog->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $auditLog->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->subject_id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->subject_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->user_id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->host ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditLog->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('audit_log_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.audit-logs.show', $auditLog->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
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
@can('root_cause_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.root-causes.massDestroy') }}",
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
  $('.datatable-RootCause:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection