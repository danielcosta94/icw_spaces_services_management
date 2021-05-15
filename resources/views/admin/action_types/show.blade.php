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
                    <h1 class="page-header text-center">{{ trans('management.action_types_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.view') . ' ' . trans('management.action_types') }}</div>
                        <div class="panel-body">
                            <div class="form-horizontal">

                                <div>
                                    <label for="name" class="col-md-4 control-label text-right">{{ trans('management.action_type') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{$action->action}}</p>
                                    </div>
                                </div>

                                <div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ route('action_types.edit', $action) }}" class="btn btn-warning" role="button">{{ trans('management.edit') }}</a>
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