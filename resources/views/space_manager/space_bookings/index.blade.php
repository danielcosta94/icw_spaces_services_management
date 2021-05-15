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
                            @if($space_bookings->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.name') . ' ' . trans_choice('management_spaces.space', 1) }}</th>
                                        <th>{{ trans('management.plan_type') }}</th>
                                        <th>{{ trans('management.status') }}</th>
                                        <th>{{ trans('management.price') }}</th>
                                        <th>{{ trans('management.period') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($space_bookings as $space_booking)
                                        <tr>
                                            <td>{{ $space_booking->id }}</td>
                                            <td>{{ $space_booking->user->first_name . ' ' . $space_booking->user->last_name }}</td>
                                            <td><a href="{{ url('/space-details', $space_booking->space_id) }}">{{ $space_booking->space->name }}</a></td>
                                            <td>{{ trans('management.' . $space_booking->space_price_plan ) }}</td>
                                            <td>{{ trans('management.' . strtolower($space_booking->status_booking) ) }}</td>
                                            <td>{{ $space_booking->price_unit * $space_booking->duration . ' ' . $space_booking->currency }}</td>
                                            <td>
                                                <p>{{$space_booking->start_datetime }} </p>
                                                <p>{{$space_booking->end_datetime }} </p>
                                            </td>

                                            <td>
                                                <a href="{{ route('space_bookings.show', $space_booking) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>

                                                @if($space_booking->status_booking == 'Reserved')
                                                    <form class="inline-block" action="{{ route('space_bookings.update', $space_booking->id) }}" method="POST">
                                                        {{ method_field('PUT') }}
                                                        {{ csrf_field() }}
                                                        <input name="status_booking" type="hidden" value="Cancelled">
                                                        <button id="{{ $space_booking->id }}" class="btn btn-danger" type="submit">{{ trans('management.cancel') }}</button>
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

                                    @if ($space_bookings->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($space_bookings->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $space_bookings->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $space_bookings->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $space_bookings->currentPage() - $half_total_links;
                                                $to = $space_bookings->currentPage() + $half_total_links;
                                                if ($space_bookings->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $space_bookings->currentPage();
                                                }
                                                if ($space_bookings->lastPage() - $space_bookings->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($space_bookings->lastPage() - $space_bookings->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($space_bookings->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $space_bookings->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($space_bookings->currentPage() == $space_bookings->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $space_bookings->url($space_bookings->lastPage()) }}">{{ trans('pagination.last') }}</a>
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