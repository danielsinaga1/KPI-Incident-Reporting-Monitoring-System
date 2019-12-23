@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.myIncidentReport.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.no_laporan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->no_laporan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.nama_pelapor') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->nama_pelapor->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.dept_origin') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_origin->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.date_incident') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_incident }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.photos') }}
                                    </th>
                                    <td>
                                        @foreach($incidentReport->photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.root_cause') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->root_cause->root_cause ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.perbaikan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->perbaikan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.pencegahan') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->pencegahan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.result') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->result->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.date_dept_action') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->date_dept_action }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.dept_designation') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->dept_designation->name   ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.action_by') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->action_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.reviewed_by') }}
                                    </th>
                                    <td>
                                        {{ $incidentReport->reviewed_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myIncidentReport.fields.acknowledge_by') }}
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

                    @if (auth()->user()->isSupervisor() || auth()->user()->isAdmin())
                    <div class="panel-footer">
                        <a href="{{ route('admin.my-incident-reports.approve2' , $incidentReport->id) }}"
                            class="btn btn-success">Approve</a>
                        <button type="button" class="btn btn-danger btn-reject"
                            onclick="return confirm('Are you sure want to reject Incident Report?')"
                            value="2">Reject</button>
                        <button class="btn btn-warning btn-approve">Approve 1</button>
                        <div class="pull-right">
                            <a class="btn btn-default" href="{{ url()->previous() }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if (auth()->user()->isManager() || auth()->user()->isAdmin())
                    <div class="panel-footer">
                        <a href="{{ route('admin.my-incident-reports.approveByManager' , $incidentReport->id) }}"
                            class="btn btn-success">Approve</a>
                        <button type="button" class="btn btn-danger btn-reject"
                            onclick="return confirm('Are you sure want to reject Incident Report?')"
                            value="2">Reject</button>
                        <button class="btn btn-warning btn-approve">Approve 1</button>
                        <div class="pull-right">
                            <a class="btn btn-default" href="{{ url()->previous() }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$('.btn-approve').click(function (event) {
        event.preventDefault();

        $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            // url: "{{ route('admin.my-incident-reports.approve', ['incidentReport_id' => $incidentReport->id]) }}",
            url: "{{ route('admin.my-incident-reports.approve1', ['incidentReport_id' => $incidentReport->id]) }}",
            data: {
                'id': {{ $incidentReport->id }},
            },
            success: function (data) {
                alert('success');
            }

        });
    });

</script>
@endsection
