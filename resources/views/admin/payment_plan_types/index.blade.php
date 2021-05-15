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
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('payment_plan_types.create') }}">{{ trans('management.add') . ' ' . trans('management.payment_plan_types') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($payment_plan_types->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.plan_type') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($payment_plan_types as $payment_plan_type)
                                        <tr>
                                            <td>{{ $payment_plan_type->id }}</td>
                                            <td>{{ $payment_plan_type->plan }}</td>
                                            <td>
                                                <form action="{{ route('payment_plan_types.destroy', $payment_plan_type) }}" method="POST">
                                                    <a href="{{ route('payment_plan_types.show', $payment_plan_type) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-danger" type="submit">{{ trans('management.delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div class="text-center">
                                    @php
                                        $link_limit = 10;
                                    @endphp

                                    @if ($payment_plan_types->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($payment_plan_types->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $payment_plan_types->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $payment_plan_types->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $payment_plan_types->currentPage() - $half_total_links;
                                                $to = $payment_plan_types->currentPage() + $half_total_links;
                                                if ($payment_plan_types->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $payment_plan_types->currentPage();
                                                }
                                                if ($payment_plan_types->lastPage() - $payment_plan_types->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($payment_plan_types->lastPage() - $payment_plan_types->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($payment_plan_types->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $payment_plan_types->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($payment_plan_types->currentPage() == $payment_plan_types->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $payment_plan_types->url($payment_plan_types->lastPage()) }}">{{ trans('pagination.last') }}</a>
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