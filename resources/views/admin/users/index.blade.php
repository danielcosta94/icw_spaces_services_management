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
                    <h1 class="page-header text-center">{{ trans('management.users_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('users.create') }}">{{ trans('management.add') . ' ' . trans('register.users') }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($users->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('register.email') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('register.user_type') }}</th>
                                        <th>{{ trans('management.active') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                            <td>{{ $user->description }}</td>
                                            <td>{{ $user->active == 1 ? trans('management.yes') : trans('management.no')}}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div class="text-center">
                                    @php
                                        $link_limit = 10;
                                    @endphp

                                    @if ($users->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $users->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $users->currentPage() - $half_total_links;
                                                $to = $users->currentPage() + $half_total_links;
                                                if ($users->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $users->currentPage();
                                                }
                                                if ($users->lastPage() - $users->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($users->lastPage() - $users->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $users->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $users->url($users->lastPage()) }}">{{ trans('pagination.last') }}</a>
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