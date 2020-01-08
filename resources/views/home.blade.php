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

                    You are logged in!
                </div>
            </div>
        </div>
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
          <!-- ./col -->
        
          {{-- <table>
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    @foreach($columns as $column)
                    <th>
                     {{$column}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
              @foreach($rows as $classify_id => $columns)
                    <tr>
                        <td>
                          <strong>{{ $classify_id }}</strong>
                        </td>
                        @foreach($columns as $cat_id => $description)
                        <td>
                            {{ $description }}
                        </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

      

    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection