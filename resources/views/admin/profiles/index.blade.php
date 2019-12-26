@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>

                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.profile.title_singular') }}
                </div>

                <div class="panel-body">
                    <div class="form-group {{ $errors->has('npk') ? 'has-error' : '' }}">
                        <label for="npk">{{ trans('cruds.user.fields.npk') }}*</label>
                        <input type="text" id="npk" name="npk" class="form-control"
                            value="{{ old('name', isset($user) ? $user->npk : '') }}" readonly>
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
                            value="{{ old('name', isset($user) ? $user->name : '') }}" readonly>
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
                            value="{{ old('email', isset($user) ? $user->email : '') }}" readonly>
                        @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.email_helper') }}
                        </p>
                    </div>
                    
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> {{ trans('global.change_password') }} </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form action="{{ route("admin.changePassword") }}" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                @csrf
                                <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                                    <label for="password">{{ trans('global.current_password') }}</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control">
                                    @if($errors->has('current_password'))
                                    <p class="help-block">
                                        {{ $errors->first('current_password') }}
                                    </p>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.password_helper') }}
                                    </p>
                                </div>

                                <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                                    <label for="new_password">{{ trans('global.new_password') }}</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">{{ trans('global.password_confirmation') }}
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control">
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection