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
                        <div class="panel-heading text-center">{{ trans('management.edit') . ' ' . trans('management.countries') }}</div>
                        <div class="panel-body">

                            @php
                                $currencies = \App\Models\Currency::all();
                            @endphp

                            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'PUT', 'route' => ['countries.update', $country->calling_code_id], 'files' => true]) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('flag_path') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <img alt="{{ $country->name }}" src="{{ Storage::url($country->flag_path) }}">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code" class="col-md-4 control-label">{{ trans('management.code') }}</label>

                                <div class="col-md-5">
                                    <input id="code" type="text" class="form-control" name="code" value="{{$country->code}}" required>

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
                                    <input id="name" type="text" class="form-control" name="name" value="{{$country->name}}" required>

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
                                    <select id="currency_code" class="form-control" name="currency_code" required>
                                        <optgroup label="{{ trans('management.currency_list') }}">
                                            @foreach($currencies as $currency)
                                                @if ($country->currency_code == $currency->code)
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

                            <div class="form-group{{ $errors->has('calling_code_id') ? ' has-error' : '' }}">
                                <label for="calling_code_id" class="col-md-4 control-label">{{ trans('management.calling_code_id') }}</label>

                                <div class="col-md-5">
                                    <input id="calling_code_id" type="text" class="form-control" name="calling_code_id" value="{{$country->calling_code_id}}" required>

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
                                    <input type="file" name="flag_path" id="flag_path"/>
                                    @if ($errors->has('flag_path'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('flag_path') }}</strong>
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