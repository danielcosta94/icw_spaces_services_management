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
                    <h1 class="page-header text-center">{{ trans('management.country_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.view') . ' ' . trans('management.countries') }}</div>
                        <div class="panel-body">
                            <div class="form-horizontal">

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.flag_country') }}</label>

                                    <div class="col-md-5">
                                        <img alt="{{ $country->name }}" src="{{ Storage::url($country->flag_path) }}">
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.code') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $country->code }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.name') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $country->name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.currency') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $country->currency->name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.calling_code_id') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{ $country->calling_code_id }}</p>
                                    </div>
                                </div>

                                <div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ route('countries.edit', $country) }}" class="btn btn-warning" role="button">{{ trans('management.edit') }}</a>
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