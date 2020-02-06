@extends('layouts.admin')
@section('content')
<div class="content">
    @can('result_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.results.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.result.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.result.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Result" id="example">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.result.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.result.fields.name') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $key => $result)
                                    <tr data-entry-id="{{ $result->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $result->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $result->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('result_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.results.show', $result->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('result_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.results.edit', $result->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('result_delete')
                                                <form action="{{ route('admin.results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('result_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.results.massDestroy') }}",
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
  $('.datatable-Result:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

('#example').DataTable().on("click", "th.select-checkbox", function() {
  if ($("th.select-checkbox").hasClass("selected")) {
    ('#example').DataTable().rows().deselect();
    $("th.select-checkbox").removeClass("selected");
  } else {
    ('#example').DataTable().rows().select();
    $("th.select-checkbox").addClass("selected");
  }
}).on("select deselect", function() {
  ("Some selection or deselection going on")
  if (('#example').DataTable().rows({
      selected: true
    }).count() !== ('#example').DataTable().rows().count()) {
    $("th.select-checkbox").removeClass("selected");
  } else {
    $("th.select-checkbox").addClass("selected");
  }
});

</script>
@endsection