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
                    <h1 class="page-header text-center">{{ trans('management_spaces.space_bookings_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">{{ trans('management.view') . ' ' . trans_choice('management_spaces.space_booking', 1) }}</div>
                        <div class="panel-body">
                            <div class="form-horizontal">

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.id') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{$space_booking->id}}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.name') . ' ' . trans_choice('management_spaces.space', 1) }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control"><a href="{{ url('/space-details', $space_booking->space_id) }}">{{ $space_booking->space->name }}</a></p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.status') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{ trans('management.' . strtolower($space_booking->status_booking) ) }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.plan_type') }}</label>

                                    <div class="col-md-7">
                                        <p class="padding-text">{{ trans('management.' . $space_booking->space_price_plan ) }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.duration') }}</label>

                                    <div class="col-md-7">
                                        <p class="padding-text">{{$space_booking->duration }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.price') }}</label>

                                    <div class="col-md-7">
                                        <p class="padding-text bold">{{$space_booking->price_unit * $space_booking->duration . ' ' . $space_booking->currency }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.period') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control bold">{{$space_booking->start_datetime}} &mdash; {{$space_booking->end_datetime}}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.payment_stripe_id') }}</label>

                                    <div class="col-md-7">
                                        <p class="padding-text">{{$space_booking->payment_stripe_id}}</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-md-3 control-label text-right">{{ trans('management.date_reservation') }}</label>

                                    <div class="col-md-7">
                                        <p class="form-control">{{$space_booking->date_reservation}}</p>
                                    </div>
                                </div>

                                @if($space_booking->date_cancellation != null)
                                    <div>
                                        <label class="col-md-3 control-label text-right">{{ trans('management.date_cancellation') }}</label>

                                        <div class="col-md-7">
                                            <p class="form-control">{{$space_booking->date_cancellation}}</p>
                                        </div>
                                    </div>
                                @endif

                                @if(count($space_booking->space_booking_availabilities()->get()) > 0)
                                    <div>
                                        <label class="col-md-3 control-label text-right">{{ trans('management.timetable') }}</label>

                                        <div class="col-md-7 padding-bottom-text">
                                            <div class="padding-text">
                                                @foreach($space_booking->space_booking_availabilities()->get() as $space_booking_availability)
                                                    <p>
                                                        <span class="bold">{{ trans('management.' . $space_booking_availability->day_week) }}</span>{{': ' . $space_booking_availability->opening_hour . 'H - ' . $space_booking_availability->closing_hour . 'H'}}
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <div class="col-md-6 col-md-offset-4">

                                        @php
                                            $id = Auth::user()->id;
                                            $user = \App\User::find($id);
                                            $userType = $user->user_type->user_type;
                                        @endphp

                                        @if($space_booking->status_booking == 'Reserved')
                                            <form class="inline-block" action="{{ route('space_bookings.update', $space_booking->id) }}" method="POST">
                                                {{ method_field('PUT') }}
                                                {{ csrf_field() }}
                                                <input name="status_booking" type="hidden" value="Cancelled">
                                                <button id="cancel" class="btn btn-danger" type="submit">{{ trans('management.cancel') }}</button>
                                            </form>

                                            <form class="inline-block" action="{{ route('space_bookings.update', $space_booking->id) }}" method="POST">
                                                {{ method_field('PUT') }}
                                                {{ csrf_field() }}
                                                <input name="status_booking" type="hidden" value="Check-In">
                                                <button id="check-in" class="btn btn-success" type="submit">{{ trans('management.check-in') }}</button>
                                            </form>
                                        @elseif($space_booking->status_booking == 'Check-In')
                                            <form class="inline-block" action="{{ route('space_bookings.update', $space_booking->id) }}" method="POST">
                                                {{ method_field('PUT') }}
                                                {{ csrf_field() }}
                                                <input name="status_booking" type="hidden" value="Check-Out">
                                                <button id="check-out" class="btn btn-danger" type="submit">{{ trans('management.check-out') }}</button>
                                            </form>
                                        @endif


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
s
@section('extra-scripts')
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/manage-space-bookings.js') }}"></script>
@endsection