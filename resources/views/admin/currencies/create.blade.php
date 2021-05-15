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
                        <div class="panel-heading text-center">{{ trans('management.add') . ' ' . trans('management.currencies') }}</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('currencies.store') }}">
                                {{ csrf_field() }}


                                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="code" class="col-md-4 control-label">{{ trans('management.code') }}</label>

                                    <div class="col-md-5">
                                        <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required>

                                        @if ($errors->has('code'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">{{ trans('management.name') }}</label>

                                    <div class="col-md-5">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                                    <label for="symbol" class="col-md-4 control-label">{{ trans('management.symbol') }}</label>

                                    <div class="col-md-5">
                                        <input id="symbol" type="text" class="form-control" name="symbol" value="{{ old('symbol') }}" required>

                                        @if ($errors->has('symbol'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('symbol') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success">{{ trans('management.add') }}</button>
                                        <input class="btn btn-primary" type="button" value="{{ trans('pagination.return') }}" onclick="window.history.back()" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection