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
                    <h1 class="page-header text-center">{{ trans('management.currency_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('currencies.create') }}">{{ trans('management.add') . ' ' . trans('management.currencies') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($currencies->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.code') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('management.symbol') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($currencies as $currency)
                                        <tr>
                                            <td>{{ $currency->code }}</td>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->symbol }}</td>
                                            <td>
                                                <form action="{{ route('currencies.destroy', $currency) }}" method="POST">
                                                    <a href="{{ route('currencies.show', $currency) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($currencies->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($currencies->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $currencies->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $currencies->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $currencies->currentPage() - $half_total_links;
                                                $to = $currencies->currentPage() + $half_total_links;
                                                if ($currencies->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $currencies->currentPage();
                                                }
                                                if ($currencies->lastPage() - $currencies->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($currencies->lastPage() - $currencies->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($currencies->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $currencies->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($currencies->currentPage() == $currencies->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $currencies->url($currencies->lastPage()) }}">{{ trans('pagination.last') }}</a>
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