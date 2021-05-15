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
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('countries.create') }}">{{ trans('management.add') . ' ' . trans('management.countries') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($countries->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.code') }}</th>
                                        <th>{{ trans('management.flag_country') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('management.currency') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($countries as $country)
                                        <tr>
                                            <td>{{ $country->code }}</td>
                                            <td><img alt="{{ $country->name }}" src="{{ Storage::url($country->flag_path) }}"></td>
                                            <td>{{ $country->name }}</td>
                                            <td>{{ $country->currency->name }}</td>
                                            <td>
                                                <form action="{{ route('countries.destroy', $country) }}" method="POST">
                                                    <a href="{{ route('countries.show', $country) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($countries->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($countries->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $countries->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $countries->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $countries->currentPage() - $half_total_links;
                                                $to = $countries->currentPage() + $half_total_links;
                                                if ($countries->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $countries->currentPage();
                                                }
                                                if ($countries->lastPage() - $countries->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($countries->lastPage() - $countries->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($countries->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $countries->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($countries->currentPage() == $countries->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $countries->url($countries->lastPage()) }}">{{ trans('pagination.last') }}</a>
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