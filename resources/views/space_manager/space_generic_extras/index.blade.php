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
                    <h1 class="page-header text-center">{{ trans('management_spaces.space_generic_extras_manager') }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('space_generic_extras.create') }}">{{ trans('management.add') . ' ' . trans_choice('management_spaces.space_generic_extra', 1) }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($space_generic_extras->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($space_generic_extras as $space_generic_extra)
                                        <tr>
                                            <td>{{ $space_generic_extra->id }}</td>
                                            <td>{{ $space_generic_extra->name }}</td>
                                            <td>
                                                <form action="{{ route('space_generic_extras.destroy', $space_generic_extra) }}" method="POST">
                                                    <a href="{{ route('space_generic_extras.show', $space_generic_extra) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($space_generic_extras->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($space_generic_extras->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $space_generic_extras->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $space_generic_extras->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $space_generic_extras->currentPage() - $half_total_links;
                                                $to = $space_generic_extras->currentPage() + $half_total_links;
                                                if ($space_generic_extras->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $space_generic_extras->currentPage();
                                                }
                                                if ($space_generic_extras->lastPage() - $space_generic_extras->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($space_generic_extras->lastPage() - $space_generic_extras->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($space_generic_extras->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $space_generic_extras->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($space_generic_extras->currentPage() == $space_generic_extras->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $space_generic_extras->url($space_generic_extras->lastPage()) }}">{{ trans('pagination.last') }}</a>
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