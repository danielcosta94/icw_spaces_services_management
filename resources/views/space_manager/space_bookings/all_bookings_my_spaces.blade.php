@extends('auth.layouts.master-man')

@section('head')
    <head>
        <title>Spaces and Services ManagementSpa</title>

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
                        <div class="panel-heading text-center">
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($all_bookings_my_spaces->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.client') }}</th>
                                        <th>{{ trans('management.name') . ' ' . trans_choice('management_spaces.space', 1) }}</th>
                                        <th>{{ trans('management.plan_type') }}</th>
                                        <th>{{ trans('management.status') }}</th>
                                        <th>{{ trans('management.price') }}</th>
                                        <th>{{ trans('management.period') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($all_bookings_my_spaces as $booking_my_space)
                                        <tr>
                                            <td>{{ $booking_my_space->id }}</td>
                                            <td>{{ $booking_my_space->user->first_name . ' ' . $booking_my_space->user->last_name }}</td>
                                            <td><a href="{{ url('/space-details', $booking_my_space->space_id) }}">{{ $booking_my_space->space->name }}</a></td>
                                            <td>{{ trans('management.' . $booking_my_space->space_price_plan ) }}</td>
                                            <td>{{ trans('management.' . strtolower($booking_my_space->status_booking) ) }}</td>
                                            <td>{{ $booking_my_space->price_unit * $booking_my_space->duration . ' ' . $booking_my_space->currency }}</td>
                                            <td>
                                                <p>{{$booking_my_space->start_datetime }} </p>
                                                <p>{{$booking_my_space->end_datetime }} </p>
                                            </td>

                                            <td>
                                                <a href="{{ route('space_bookings.show', $booking_my_space) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>

                                                @if($booking_my_space->status_booking == 'Reserved')
                                                    <form class="inline-block" action="{{ route('space_bookings.update', $booking_my_space->id) }}" method="POST">
                                                        {{ method_field('PUT') }}
                                                        {{ csrf_field() }}
                                                        <input name="status_booking" type="hidden" value="Cancelled">
                                                        <button id="{{ $booking_my_space->id }}" class="btn btn-danger" type="submit">{{ trans('management.cancel') }}</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div class="text-center">
                                    @php
                                        $link_limit = 10;
                                    @endphp

                                    @if ($all_bookings_my_spaces->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($all_bookings_my_spaces->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $all_bookings_my_spaces->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $all_bookings_my_spaces->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $all_bookings_my_spaces->currentPage() - $half_total_links;
                                                $to = $all_bookings_my_spaces->currentPage() + $half_total_links;
                                                if ($all_bookings_my_spaces->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $all_bookings_my_spaces->currentPage();
                                                }
                                                if ($all_bookings_my_spaces->lastPage() - $all_bookings_my_spaces->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($all_bookings_my_spaces->lastPage() - $all_bookings_my_spaces->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($all_bookings_my_spaces->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $all_bookings_my_spaces->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($all_bookings_my_spaces->currentPage() == $all_bookings_my_spaces->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $all_bookings_my_spaces->url($all_bookings_my_spaces->lastPage()) }}">{{ trans('pagination.last') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>

                            @else
                                <p class="alert alert-danger text-center">{{ trans('management.empty_records') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/manage-space-bookings.js') }}"></script>
@endsection