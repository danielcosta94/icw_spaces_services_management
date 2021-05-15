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
                    <h1 class="page-header text-center">{{ trans('management.action_types_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('action_types.create') }}">{{ trans('management.add') . ' ' . trans('management.action_types') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($actions->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.action_type') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($actions as $action)
                                        <tr>
                                            <td>{{ $action->id }}</td>
                                            <td>{{ $action->action }}</td>
                                            <td>
                                                <form action="{{ route('action_types.destroy', $action) }}" method="POST">
                                                    <a href="{{ route('action_types.show', $action) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($actions->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($actions->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $actions->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $actions->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $actions->currentPage() - $half_total_links;
                                                $to = $actions->currentPage() + $half_total_links;
                                                if ($actions->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $actions->currentPage();
                                                }
                                                if ($actions->lastPage() - $actions->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($actions->lastPage() - $actions->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($actions->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $actions->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($actions->currentPage() == $actions->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $actions->url($actions->lastPage()) }}">{{ trans('pagination.last') }}</a>
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