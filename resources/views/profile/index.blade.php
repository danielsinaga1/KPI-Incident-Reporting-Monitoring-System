@extends('layouts.admin')
@section('content')
<div class="content">
    <section class="content-header">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h3 class="profile-user text-center">
                                {{auth()->user()->name}}
                            </h3>
                            <p class="profile-username text-center">{{auth()->user()->team_id}}
                            </p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">{{ trans('') }}</li>
                                <li class="list-group-item"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">

                </div>
            </div>
        </section>
    </section>
</div>
@endsection

