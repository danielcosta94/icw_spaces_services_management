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
                    <h1 class="page-header text-center">{{ trans('management.business_verticals_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('business_verticals.create') }}">{{ trans('management.add') . ' ' . trans_choice('management.business_vertical', 1) }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($verticals->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($verticals as $vertical)
                                        <tr>
                                            <td>{{ $vertical->id }}</td>
                                            <td>{{ $vertical->name }}</td>
                                            <td>
                                                <form action="{{ route('business_verticals.destroy', $vertical) }}" method="POST">
                                                    <a href="{{ route('business_verticals.show', $vertical) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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
                                        $link_limit = 5;
                                    @endphp

                                    @if ($verticals->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($verticals->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $verticals->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $verticals->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $verticals->currentPage() - $half_total_links;
                                                $to = $verticals->currentPage() + $half_total_links;
                                                if ($verticals->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $verticals->currentPage();
                                                }
                                                if ($verticals->lastPage() - $verticals->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($verticals->lastPage() - $verticals->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($verticals->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $verticals->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($verticals->currentPage() == $verticals->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $verticals->url($verticals->lastPage()) }}">{{ trans('pagination.last') }}</a>
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