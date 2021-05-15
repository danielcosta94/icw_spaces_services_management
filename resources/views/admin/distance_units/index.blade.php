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
                    <h1 class="page-header text-center">{{ trans('management.distance_unit_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('distance_units.create') }}">{{ trans('management.add') . ' ' . trans('management.distance_units') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($distance_units->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.symbol') }}</th>
                                        <th>{{ trans('management.description') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($distance_units as $distance_unit)
                                        <tr>
                                            <td>{{ $distance_unit->symbol }}</td>
                                            <td>{{ $distance_unit->description }}</td>
                                            <td>
                                                <form action="{{ route('distance_units.destroy', $distance_unit) }}" method="POST">
                                                    <a href="{{ route('distance_units.show', $distance_unit) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($distance_units->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($distance_units->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $distance_units->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $distance_units->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $distance_units->currentPage() - $half_total_links;
                                                $to = $distance_units->currentPage() + $half_total_links;
                                                if ($distance_units->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $distance_units->currentPage();
                                                }
                                                if ($distance_units->lastPage() - $distance_units->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($distance_units->lastPage() - $distance_units->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($distance_units->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $distance_units->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($distance_units->currentPage() == $distance_units->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $distance_units->url($distance_units->lastPage()) }}">{{ trans('pagination.last') }}</a>
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