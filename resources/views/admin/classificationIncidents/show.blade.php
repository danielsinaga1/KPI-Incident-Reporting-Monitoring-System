@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.classificationIncident.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $classificationIncident->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $classificationIncident->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.code') }}
                                    </th>
                                    <td>
                                        {{ $classificationIncident->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $classificationIncident->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.classificationIncident.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $classificationIncident->description !!}
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