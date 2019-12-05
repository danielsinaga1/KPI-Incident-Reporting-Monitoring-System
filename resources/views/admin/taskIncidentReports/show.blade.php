@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.taskIncidentReport.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.nama_pelapor') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->nama_pelapor->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.dept_origin') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_origin->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.date_incident') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_incident }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.root_cause') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->root_cause->root_cause ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.perbaikan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->perbaikan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.pencegahan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->pencegahan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.result') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->result->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.date_dept_action') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_dept_action }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.dept_designation') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_designation->name   ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.reviewed_by') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->reviewed_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.taskIncidentReport.fields.acknowledge_by') }}
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