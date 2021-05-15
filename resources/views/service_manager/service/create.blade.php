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
                    <h1 class="page-header">{{ trans('management.main_panel') }}</h1>
                </div>
            </div>

            <div class="container-fluid photo-gallery">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">{{ trans('register.new_service') }}</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.first_name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('business_vertical_id') ? ' has-error' : '' }}">
                                        <label for="business_vertical_id" class="col-md-4 control-label">{{ trans('register.business_vertical_id') }}</label>

                                        <div class="col-md-6">
                                            <select id="business_vertical_id" name="business_vertical_id" required>
                                                <?php
                                                $buss_verticals = \App\Models\BusinessVertical::all()
                                                ?>
                                                @foreach($buss_verticals as $bussiness_vertical)
                                                    @if (old('business_vertical_id') == $bussiness_vertical->id)
                                                        <option value="{{$bussiness_vertical->id}}}" selected>{{$bussiness_vertical->name}}</option>
                                                    @else
                                                        <option value="{{$bussiness_vertical->id}}">{{$bussiness_vertical->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('business_vertical_id'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('1') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">{{ trans('register.email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                        <label for="business_vertical_id" class="col-md-4 control-label">{{ trans('register.select_country_id') }}</label>

                                        <div class="col-md-6">
                                            <select id="country_id" name="country_id" required>
                                                <?php
                                                $countries = \App\Models\Country::all()
                                                ?>
                                                @foreach($countries as $country)
                                                    @if (old('country_id') == $country->currency_code)
                                                        <option value="{{$country->currency_code}}}" selected>{{$country->name}}</option>
                                                    @else
                                                        <option value="{{$country->currency_code}}">{{$country->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('country_id'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('1') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_telephone_number') }}</label>

                                        <div class="col-md-6">
                                            <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>

                                            @if ($errors->has('telephone'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_mobile_number') }}</label>

                                        <div class="col-md-6">
                                            <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_website') }}</label>

                                        <div class="col-md-6">
                                            <input id="website" type="url" class="form-control" name="website" value="{{ old('website') }}" required>

                                            @if ($errors->has('website'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('website') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('distance_unit_symbol') ? ' has-error' : '' }}">
                                        <label for="distance_unit_symbol" class="col-md-4 control-label">{{ trans('register.select_distance_unit_symbol') }}</label>

                                        <div class="col-md-6">
                                            <select id="distance_unit_symbol" name="distance_unit_symbol" required>
                                                <?php
                                                $distances = \App\Models\DistanceUnit::all()
                                                ?>
                                                @foreach($distances as $distance)
                                                    @if (old('distance_unit_symbol') == $distance->symbol)
                                                        <option value="{{$distance->symbol}}}" selected>{{$distance->decription}}</option>
                                                    @else
                                                        <option value="{{$distance->symbol}}">{{$distance->decription}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            @if ($errors->has('distance_unit_symbol'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('1') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('radius_action') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_radius_action') }}</label>

                                        <div class="col-md-6">
                                            <input id="radius_action" type="number" class="form-control" name="radius_action" value="{{ old('radius_action') }}" required>

                                            @if ($errors->has('radius_action'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('radius_action') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_lat') }}</label>

                                        <div class="col-md-6">
                                            <input id="latitude" type="number" class="form-control" name="latitude" value="{{ old('latitude') }}" required>

                                            @if ($errors->has('latitude'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_long') }}</label>

                                        <div class="col-md-6">
                                            <input id="longitude" type="number" class="form-control" name="longitude" value="{{ old('longitude') }}" required>

                                            @if ($errors->has('longitude'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ trans('register.select_description') }}</label>

                                        <textarea class="col-md-6" input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                            @endif
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">{{ trans('navigation_menu.register') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection