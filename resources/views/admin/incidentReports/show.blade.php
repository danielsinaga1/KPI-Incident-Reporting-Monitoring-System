@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.incidentReport.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.nama_pelapor') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->nama_pelapor->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.dept_origin') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_origin->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.date_incident') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_incident }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.root_cause') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->root_cause->root_cause ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.perbaikan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->perbaikan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.pencegahan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->pencegahan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.date_dept_action') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_dept_action }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.dept_addressed_to') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_addressed_to->dept_name_address ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.reviewed_by') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->reviewed_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.incidentReport.fields.acknowledge_by') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->acknowledge_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection