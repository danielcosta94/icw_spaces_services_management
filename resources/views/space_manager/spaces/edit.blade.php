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
                    <h1 class="page-header text-center">{{ trans('management.edit') . ' ' . trans_choice('management_spaces.space', 1) }}</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row form-group">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="active">
                            <a href="#step-1">
                                <h4 class="list-group-item-heading">{{ trans('management.part') . ' 1'}}</h4>
                                <p class="list-group-item-text">{{ trans('management.general_informations') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <h4 class="list-group-item-heading">{{ trans('management.part') . ' 2'}}</h4>
                                <p class="list-group-item-text">{{ trans('management.detailed_informations') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <h4 class="list-group-item-heading">{{ trans('management.part') . ' 3'}}</h4>
                                <p class="list-group-item-text">{{ trans('management.prices_table') . '/' . trans('management.timetable') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <h4 class="list-group-item-heading">{{ trans('management.part') . ' 4'}}</h4>
                                <p class="list-group-item-text">{{ trans('management.amenities') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {!! Form::open(['class' => 'form-horizontal', 'enctype' => 'multipart/form-data','role' => 'form', 'method' => 'PUT', 'route' => ['spaces.update', $space->id]]) !!}
        {{ csrf_field() }}


        <div class="container">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12 well text-center">

                        <fieldset class="padding-bottom-text">
                            <legend>{{ trans('management.general_informations') }}</legend>

                            <input id="latitude" name="latitude" type="number" value="{{ $space->latitude }}" hidden required>
                            <input id="longitude" name="longitude" type="number" value="{{ $space->longitude }}" hidden required>

                            <section class="google-map padding-bottom-text">


                                <div class="container-fluid padding-fix wow fadeInUp">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-7">
                                            <label for="space_type_id" class="control-label padding-bottom-text">{{ trans('management_spaces.select_space_locaton') }}</label>
                                            <div id="property-map"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">{{ trans('management.name') }}</label>

                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $space->name }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('space_type_id') ? ' has-error' : '' }}">
                                <label for="space_type_id" class="col-md-3 control-label">{{ trans_choice('management_spaces.space_type', 1) }}</label>

                                <div class="col-md-4">
                                    <select id="space_type_id" class="form-control" name="space_type_id" required>
                                        <option selected disabled>{{ trans('management_spaces.select_space_type') }}</option>
                                        @foreach($space_types as $space_type)
                                            @if ($space->space_type_id == $space_type->id)
                                                <option value="{{$space_type->id}}" selected>{{$space_type->space_type}}</option>
                                            @else
                                                <option value="{{$space_type->id}}">{{$space_type->space_type}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('space_type_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('space_type_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="website" class="col-md-3 control-label">{{ trans('management_spaces.website') }}</label>

                                <div class="col-md-7">
                                    <input id="website" type="url" class="form-control" name="website" value="{{ $space->website }}">

                                    @if ($errors->has('website'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telephone_number') ? ' has-error' : '' }}">
                                <label for="telephone_number" class="col-md-3 control-label">{{ trans('management_spaces.telephone_number') }}</label>

                                <div class="col-md-7">
                                    <input id="telephone_number" type="text" class="form-control" name="telephone_number" value="{{ $space->telephone_number }}" required>

                                    @if ($errors->has('telephone_number'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('telephone_number') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">{{ trans('register.email') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $space->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12 well text-center">


                        <fieldset class="padding-bottom-text">
                            <legend>{{ trans('management.detailed_informations') }}</legend>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-3 control-label">{{ trans('management.description') }}</label>

                                <div class="col-md-7">
                                    <textarea id="description" type="text" class="form-control text_height" name="description" required>{{ $space->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_vertical_id') ? ' has-error' : '' }}">
                                <label for="business_vertical_id" class="col-md-3 control-label">{{ trans_choice('management_spaces.business_vertical', 1) }}</label>

                                <div class="col-md-4">
                                    <select id="business_vertical_id" class="form-control" name="business_vertical_id" required>
                                        <option selected disabled>{{ trans('management_spaces.select_business_vertical') }}</option>
                                        @foreach($business_verticals as $business_vertical)
                                            @if ($space->business_vertical_id == $business_vertical->id)
                                                <option value="{{$business_vertical->id}}" selected>{{$business_vertical->name}}</option>
                                            @else
                                                <option value="{{$business_vertical->id}}">{{$business_vertical->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('business_vertical_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('business_vertical_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-3 control-label">{{ trans('management_spaces.capacity') }}</label>

                                <div class="col-md-7">
                                    <input id="capacity" type="number" min="1" class="form-control" name="capacity" value="{{ $space->capacity }}" required>

                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('capacity') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12 well text-center">
                        <div class="row clearfix">

                            <fieldset class="padding-bottom-text">
                                <legend>{{ trans('management.prices_table') }}</legend>

                                @foreach($payment_plan_types as $payment_plan_type)
                                    <div class="form-group{{ $errors->has('price_' . $payment_plan_type->plan) ? ' has-error' : '' }}">
                                        <label for="price_{{ $payment_plan_type->plan }}" class="col-md-4 control-label">{{ trans('management.price_' . $payment_plan_type->plan) }}</label>

                                        <div class="col-md-4">
                                            @forelse($space_price_plans_details->where('plan', $payment_plan_type->plan) as $space_price_plan_detail)
                                                <input id="price_{{ $payment_plan_type->plan }}" type="number" min="1" class="form-control inline-block" name="price_{{ $payment_plan_type->plan }}" value="{{ $space_price_plan_detail->price }}">

                                                <div class="inline-block padding-fix-left">
                                                    @if($space_price_plan_detail->active)
                                                        <input id="price_{{ $payment_plan_type->plan }}_check" name="price_{{ $payment_plan_type->plan }}_check" type="checkbox" checked>
                                                    @else
                                                        <input id="price_{{ $payment_plan_type->plan }}_check" name="price_{{ $payment_plan_type->plan }}_check" type="checkbox">
                                                    @endif
                                                </div>
                                            @empty
                                                <input id="price_{{ $payment_plan_type->plan }}" type="number" min="1" class="form-control inline-block" name="price_{{ $payment_plan_type->plan }}" value="{{ old('price_' . $payment_plan_type->plan) }}">

                                                <div class="inline-block padding-fix-left">
                                                    <input id="price_{{ $payment_plan_type->plan }}_check" name="price_{{ $payment_plan_type->plan }}_check" type="checkbox">
                                                </div>
                                            @endforelse

                                            @if ($errors->has('price_' . $payment_plan_type->plan))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('price_' . $payment_plan_type->plan) }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>

                            <fieldset>
                                <legend>{{ trans('management.timetable') }}</legend>

                                <div class="row">
                                    @php
                                        $week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                    @endphp

                                    @foreach($week_days as $week_day)
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">{{ trans('management.' . $week_day) }}</label>

                                            <div class="col-md-4">
                                                <select id="{{ $week_day }}_opening_hour" name="{{ $week_day }}_opening_hour">
                                                    @forelse($space->space_availabilties()->where('day_week', $week_day)->get() as $space_availability)
                                                        @for ($i = 0; $i < 24; $i++)
                                                            @if($space_availability->opening_hour != $i)
                                                                <option value="{{ $i }}">{{ $i }}H</option>
                                                            @else
                                                                <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                            @endif
                                                        @endfor
                                                    @empty
                                                        @for ($i = 0; $i < 24; $i++)
                                                            @if(old($week_day . '_opening_hour') == null)
                                                                @if($i != '9')
                                                                    <option value="{{ $i }}">{{ $i }}H</option>
                                                                @else
                                                                    <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                                @endif
                                                            @else
                                                                @if(old($week_day . '_opening_hour') == $i)
                                                                    <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                                @else
                                                                    <option value="{{ $i }}">{{ $i }}H</option>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @endforelse
                                                </select>

                                                {{ trans('management.to') }}&nbsp;

                                                <select id="{{ $week_day }}_closing_hour" name="{{ $week_day }}_closing_hour">
                                                    @forelse($space->space_availabilties()->where('day_week', $week_day)->get() as $space_availability)
                                                        @for ($i = 0; $i < 24; $i++)
                                                            @if($space_availability->closing_hour != $i)
                                                                <option value="{{ $i }}">{{ $i }}H</option>
                                                            @else
                                                                <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                            @endif
                                                        @endfor
                                                    @empty
                                                        @for($i = 0; $i < 24; $i++)
                                                            @if(old($week_day . '_closing_hour') == null)
                                                                @if($i != '17')
                                                                    <option value="{{ $i }}">{{ $i }}H</option>
                                                                @else
                                                                    <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                                @endif
                                                            @else
                                                                @if(old($week_day . '_closing_hour') == $i)
                                                                    <option value="{{ $i }}" selected>{{ $i }}H</option>
                                                                @else
                                                                    <option value="{{ $i }}">{{ $i }}H</option>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @endforelse
                                                </select>

                                                <div class="inline-block padding-fix-left">
                                                    @if(count($space->space_availabilties()->where('day_week', $week_day)->get()) > 0)
                                                        <input id="{{ $week_day }}_check" name="{{ $week_day }}_check" type="checkbox" checked>
                                                    @else
                                                        <input id="{{ $week_day }}_check" name="{{ $week_day }}_check" type="checkbox">
                                                    @endif
                                                    <label class="control-label">{{ trans('management.open') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row setup-content" id="step-4">
                    <div class="col-xs-12">
                        <div class="col-md-12 well text-center">

                            <fieldset class="padding-bottom-text">
                                <legend>{{ trans_choice('management_spaces.space_generic_extra', 2) }}</legend>

                                <div class="container-fluid text-left">
                                    @forelse($space_generic_extras as $space_generic_extra)
                                        <div class="row">
                                            @if(count(\App\Models\SpaceExtra::where('space_extra_id', $space_generic_extra->id)->where('space_id', $space->id)->get()) > 0)
                                                <input id="{{ 'extra_id_' . $space_generic_extra->id }}" name="{{ 'extra_id_' . $space_generic_extra->id }}" type="checkbox" checked>
                                            @else
                                                <input id="{{ 'extra_id_' . $space_generic_extra->id }}" name="{{ 'extra_id_' . $space_generic_extra->id }}" type="checkbox">
                                            @endif
                                            <label>{{ $space_generic_extra->name }}</label>
                                        </div>
                                    @empty
                                        <p class="alert alert-danger text-center">{{ trans('management.empty_records') }}</p>
                                    @endforelse
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center padding-bottom-text">
                <button id="submit_space" type="submit" class="btn btn-success">{{ trans('management.update') }}</button>
                <input class="btn btn-primary" type="button" value="{{ trans('pagination.return') }}" onclick="window.history.back()" />
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('extra-scripts')
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAh_y634oRbkYzDn9r8PuJT_Rk4azff1ao'></script>
    <script src="{{ asset('/js/google-map-select.js') }}"></script>
    <script src="{{ asset('/js/manage-space.js') }}"></script>
@endsection

