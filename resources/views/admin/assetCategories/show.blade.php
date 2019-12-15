@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.assetCategory.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $assetCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetCategory.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $assetCategory->name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="col-lg-12">
                                <div class="col-lg-8">
                                        <a class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-success" style="text-right">Approve</button>
                        <button type="button" class="btn btn-danger" style="">Reject</button>
                    </div>

                </div> --}}
                @if (auth()->user()->isSupervisor())
                <div class="panel-footer">
                    <button type="button" class="btn btn-success">Approve</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                    <div class="pull-right">
                        <a class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
                @endif
            </div>


            <ul class="nav nav-tabs">

            </ul>
            <div class="tab-content">

            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection