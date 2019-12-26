@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{ trans('global.edit') }} {{ trans('cruds.profile.title.singular') }}
            </div>
            <div class="panel-body">

                <form action="{{ route("admin.profiles.update", [$user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group {{ $errors->has('npk') ? 'has-error' : '' }}">
                        <label for="npk">{{ trans('cruds.user.fields.npk') }}*</label>
                        <input type="text" id="npk" name="npk" class="form-control"
                            value="{{ old('name', isset($user) ? $user->npk : '') }}" required>
                        @if($errors->has('npk'))
                        <p class="help-block">
                            {{ $errors->first('npk') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.npk_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                        @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.name_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                        @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.email_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.password_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
                        <label for="role">{{ trans('cruds.user.fields.role') }}</label>
                        <select name="role_id" id="role" class="form-control select2">
                            @foreach($roles as $id => $role)
                            <option value="{{ $id }}"
                                {{ (isset($user) && $user->role ? $user->role->id : old('role_id')) == $id ? 'selected' : '' }}>
                                {{ $role }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('team_id') ? 'has-error' : '' }}">
                        <label for="team">{{ trans('cruds.user.fields.department') }}</label>
                        <select name="team_id" id="team" class="form-control select2">
                            @foreach($teams as $id => $team)
                            <option value="{{ $id }}"
                                {{ (isset($user) && $user->team ? $user->team->id : old('team_id')) == $id ? 'selected' : '' }}>
                                {{ $team }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('team_id'))
                        <p class="help-block">
                            {{ $errors->first('team_id') }}
                        </p>
                        @endif
                    </div>
                    <div>
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection