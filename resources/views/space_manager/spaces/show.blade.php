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
                    <h1 class="page-header text-center">{{ trans('management.view') . ' ' . trans_choice('management_spaces.space', 1) }}</h1>
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

        <div class="container">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12 well">

                        <fieldset class="padding-bottom-text text-center">
                            <legend>{{ trans('management.general_informations') }}</legend>

                            <div class="form-horizontal">
                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.coordinates_gps') }}</label>

                                    <div class="col-md-7 padding-bottom-text">
                                        <p class="form-control" id="coordinates_gps">{{ $space->latitude . ',' . $space->longitude }}</p>
                                        <div id="property-map"></div>
                                    </div>
                                </div>


                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.name') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans_choice('management_spaces.space_type', 1) }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->space_type->space_type }}</p>
                                    </div>
                                </div>

                                @if($space->website != null)
                                    <div>
                                        <label class="col-md-3 control-label text-right">{{ trans('management_spaces.website') }}</label>

                                        <div class="col-md-7">
                                            <a href="{{ $space->website }}"><p class="form-control">{{ $space->website }}</p></a>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management_spaces.telephone_number') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->telephone_number }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('register.email') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->email }}</p>
                                    </div>
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
                    <div class="col-md-12 well">

                        <fieldset class="padding-bottom-text text-center">
                            <legend>{{ trans('management.detailed_informations') }}</legend>
                            <div class="form-horizontal">

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.description') }}</label>

                                    <div class="col-md-7 padding-bottom-text">
                                        <div class="padding-text text-justify">{{ $space->description }}</div>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management_spaces.business_vertical') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->business_vertical->name }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 text-right">{{ trans('management_spaces.space_photos') }}</label>

                                    <div class="col-md-7">
                                        @foreach( $space->space_photos()->get() as $space_photo)
                                            <a href="{{ Storage::url($space_photo->path) }}"><img class="logo_img padding-bottom-text" src="{{ Storage::url($space_photo->path) }}"></a>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management_spaces.capacity') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ $space->capacity }}</p>
                                    </div>
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
                    <div class="col-md-12 well">

                        <fieldset class="padding-bottom-text text-center">
                            <legend>{{ trans('management.prices_table') }}</legend>

                            <div class="form-horizontal">
                                @forelse($space->space_price_plans()->get() as $space_price_plan)
                                    <div class="form-horizontal">
                                        <label class="col-md-5 control-label text-right">{{ trans('management.price_' . $space_price_plan->payment_plan_type->plan) }}</label>

                                        <div class="col-md-3">
                                            <p class="form-control">{{ $space_price_plan->price }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center has-error">
                                        <label class="control-label">{{ trans('management.empty_records') }}</label>
                                    </div>
                                @endforelse
                            </div>
                        </fieldset>


                        <fieldset class="padding-bottom-text text-center">
                            <legend>{{ trans('management.timetable') }}</legend>

                            <div class="form-horizontal">
                                @php
                                    $week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                @endphp

                                @forelse($week_days as $week_day)
                                    @php
                                        $space_availability = \App\Models\SpaceAvailabilty::where('day_week', $week_day)->where('space_id', $space->id)->first();
                                    @endphp
                                    @if($space_availability != null)

                                        <label class="col-md-5 control-label text-right">{{ trans('management.' . $space_availability->day_week) }}</label>

                                        <div class="col-md-3">
                                            <p class="form-control">{{ $space_availability->opening_hour . 'h' . ' '. trans('management.to'). ' ' . $space_availability->closing_hour }}</p>
                                        </div>
                                    @endif
                                @empty
                                    <div class="text-center has-error">
                                        <label class="control-label">{{ trans('management.empty_records') }}</label>
                                    </div>
                                @endforelse
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

                            <div id="space_extras_generic" class="property-features">

                                @if(count($space->space_extras()->get()) > 0)
                                    <ul class="list-features text-justify">
                                        @foreach($space->space_extras()->get() as $space_extra)
                                            <li><strong>{{ ' '. $space_extra->space_extras_generic->name }}</strong></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="alert alert-danger text-center">{{ trans('management.empty_records') }}</p>
                                @endif
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center padding-bottom-text">
            <a href="{{ route('spaces.edit', $space) }}" class="btn btn-warning" role="button">{{ trans('management.edit') }}</a>

            @if($space->active)
                <button id="disable_space" class="btn btn-danger">{{ trans('management.disable') }}</button>
                <button id="enable_space" class="btn btn-success collapse">{{ trans('management.enable') }}</button>
            @else
                <button id="enable_space" class="btn btn-success">{{ trans('management.enable') }}</button>
                <button id="disable_space" class="btn btn-danger collapse">{{ trans('management.disable') }}</button>
            @endif

            @php
                $id = Auth::user()->id;
                $user = \App\User::find($id);
                $userType = $user->user_type->user_type;
            @endphp

            @if($userType == 'admin')
                @if($space->validated)
                    <button id="invalidate_space" class="btn btn-danger">{{ trans('management.invalidate') }}</button>
                    <button id="validate_space" class="btn btn-success collapse">{{ trans('management.validate') }}</button>
                @else
                    <button id="validate_space" class="btn btn-success">{{ trans('management.enable') }}</button>
                    <button id="invalidate_space" class="btn btn-danger collapse">{{ trans('management.disable') }}</button>
                @endif
            @endif

            <form class="inline-block" action="{{ route('spaces.destroy', $space) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button class="btn btn-delete" type="submit">{{ trans('management.delete') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAh_y634oRbkYzDn9r8PuJT_Rk4azff1ao'></script>
    <script src="{{ asset('/js/google-map-space-details.js') }}"></script>
    <script src="{{ asset('/js/manage-space.js') }}"></script>
@endsection

