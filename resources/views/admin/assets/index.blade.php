@extends('layouts.admin')
@section('content')
<div class="content">
    @can('asset_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.assets.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.serial_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.photos') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.assigned_to') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr data-entry-id="{{ $asset->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $asset->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->serial_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($asset->photos)
                                                @foreach($asset->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                                      {{ trans('global.view_file') }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{ $asset->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->assigned_to->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.assets.show', $asset->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.assets.edit', $asset->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_delete')
                                                <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Table Matrix Incident Report</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><!-- Empty for the left top corner of the table --></th>
                                @foreach($columns as $column)
                                <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $cat_id => $columns)
                            <tr>
                                <td><strong>{{ $cat_id }}</strong></td>
                                @foreach($columns as $classify_id => $description)
                                <td>{!! $description !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
             

              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Donut Chart</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <figure class="highcharts-figure">
                        <div id="pieChart"></div>    
                    </figure>  
                </div>
                <!-- /.box-body -->
              </div>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Stack Bar Chart</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <figure class="highcharts-figure">
                        <div id="stackBar"></div>
                    </figure>
     
                </div>
                <!-- /.box-body -->
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
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
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
  $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

Highcharts.chart('pieChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
        },
        title: {
            text: 'Kategori Insiden'
            },
            subtitle: {
                text: 'Per Tahun'
            },
            credits: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                 valueSuffix: '%'
             }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        connectorColor: 'red'
                    },
                    showInLegend: true,
                }
            },
            
            series: [{
                type: 'pie',
                name: 'Persentase',
                
                data: {!!json_encode($data2)!!},
            }]
        });

Highcharts.chart('stackBar', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Follow up Rekomendasi'
    },
    colors: ['#2f7ed8', '#0d233a', '#8bbc21'],
    xAxis: {
        categories: ['Close', 'Open', 'Total']
    },
    credits: {
        enabled: false
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Per Bulan'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Grand Total',
        data: [{{ $countCloseCorrectivePreventive }}, {{ $countOpenCorrectivePreventive }}, {{ $countCorrectivePreventive }}]  
    }, {
        name: 'Preventive', 
        data: [{{$countClosePreventive}}, {{$countOpenPreventive}}, {{$countPreventive}}]
    }, {
        name: 'Corrective',
        data: [{{$countCloseCorrective}}, {{$countOpenCorrective}}, {{$countCorrective}}]
    }]
});
</script>  
@endsection