@extends('auth.layouts.master-man')

@section('head')
    <head>
        <title>Spaces and Services Management</title>

        @include('auth.layouts.styles-man')
    </head>
@endsection

@section('content')
    @include('auth.layouts.nav-bar-man')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">{{ trans('management.users_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.view') . ' ' . trans('register.users') }}</div>
                        <div class="panel-body">
                            <div class="form-horizontal">

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('register.email') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('register.first_name') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->first_name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('register.last_name') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->last_name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.active') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->active == 1 ? trans('management.yes') : trans('management.no') }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.mobile_number') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->mobile_number }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.telephone_number') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->telephone_number }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('register.user_type') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->user_type->description }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.linkedin_profile') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->linkedin_profile }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.facebook_profile') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $user->facebook_profile }}</p>
                                    </div>
                                </div>


                                <div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning" role="button">{{ trans('management.edit') }}</a>
                                        <input class="btn btn-primary" type="button" value="{{ trans('pagination.return') }}" onclick="window.history.back()" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection