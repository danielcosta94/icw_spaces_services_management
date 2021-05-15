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
                    <h1 class="page-header text-center">{{ trans('management.currency_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.view') . ' ' . trans('management.currencies') }}</div>
                        <div class="panel-body">
                            <div class="form-horizontal">
                                
                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.code') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{$currency->code}}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.name') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{$currency->name}}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-4 control-label text-right">{{ trans('management.symbol') }}</label>

                                    <div class="col-md-5">
                                        <p class="form-control">{{$currency->symbol}}</p>
                                    </div>
                                </div>

                                <div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <a href="{{ route('currencies.edit', $currency) }}" class="btn btn-warning" role="button">{{ trans('management.edit') }}</a>
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