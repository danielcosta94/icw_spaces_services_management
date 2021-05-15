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
                        <div class="panel-heading text-center">{{ trans('management.add') . ' ' . trans('management.countries') }}</div>
                        <div class="panel-body">
                            @if(Session::has('message-no-picture-error'))
                                <div class="alert alert-danger">{{ Session::get('message-no-picture-error') }}</div>
                            @elseif(Session::has('message-invalid-format-picture-error'))
                                <div class="alert alert-danger">{{ Session::get('message-invalid-format-picture-error') }}</div>
                            @endif

                            @php
                                $currencies = \App\Models\Currency::all();
                            @endphp

                            @if(count($currencies))
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('countries.store') }} " enctype="multipart/form-data">
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

                                    <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                                        <label for="currency_code" class="col-md-4 control-label">{{ trans('management.currency') }}</label>

                                        <div class="col-md-5">
                                            <select class="form-control" id="currency_code" name="currency_code" required>
                                                <option selected disabled>{{ trans('management.select_currency') }}</option>
                                                <optgroup label="{{ trans('management.currency_list') }}">
                                                    @foreach($currencies as $currency)
                                                        @if (old('currency_code') == $currency->code)
                                                            <option value="{{$currency->code}}" selected>{{$currency->name}}</option>
                                                        @else
                                                            <option value="{{$currency->code}}">{{$currency->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                            @if ($errors->has('currency_code'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                                        <label for="calling_code_id" class="col-md-4 control-label">{{ trans('management.calling_code_id') }}</label>

                                        <div class="col-md-5">
                                            <input id="calling_code_id" type="text" class="form-control" name="calling_code_id" value="{{ old('calling_code_id') }}" required>

                                            @if ($errors->has('calling_code_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('calling_code_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('flag_path') ? ' has-error' : '' }}">
                                        <label for="flag_path" class="col-md-4 control-label">{{ trans('management.flag_country') }}</label>

                                        <div class="col-md-6">
                                            <input type="file" name="flag_path" id="flag_path" required/>
                                            @if ($errors->has('flag_path'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('flag_path') }}</strong>
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
                            @else
                                <p class="alert alert-danger text-center">{{ trans('management.empty_currencies') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
