@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>

                <div class="panel-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>150</h3>

                                <p>{{ trans('panel.total_report') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>{{ trans('panel.status.approved') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>44</h3>

                                <p>{{ trans('panel.status.pending') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-hand-paper-o"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>65</h3>

                                <p>{{ trans('panel.status.rejected') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
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
@endsection
@section('scripts')
@parent
<script>
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