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
                    <h1 class="page-header text-center">{{ trans('management.payment_plan_types_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.edit') . ' ' . trans('management.payment_plan_types') }}</div>
                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT', 'route' => ['payment_plan_types.update', $payment_plan_type->id]]) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                                <label for="plan" class="col-md-4 control-label">{{ trans('management.plan_type') }}</label>

                                <div class="col-md-5">
                                    <input id="plan" type="text" class="form-control" name="plan" value="{{$payment_plan_type->plan}}" required>

                                    @if ($errors->has('plan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('plan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">{{ trans('management.update') }}</button>
                                    <input class="btn btn-primary" type="button" value="{{ trans('pagination.return') }}" onclick="window.history.back()" />
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection