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
                    <h1 class="page-header text-center">{{ trans_choice('management_spaces.space_manager', 2) }}</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid photo-gallery">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <a class="btn btn-link" href="{{ route('spaces.create') }}">{{ trans('management.add') . ' ' . trans_choice('management_spaces.space', 1) }}</a>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @elseif(Session::has('message-error'))
                                <div class="alert alert-danger">{{ Session::get('message-error') }}</div>
                            @endif
                            @if($spaces->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('management.id') }}</th>
                                        <th>{{ trans('management.name') }}</th>
                                        <th>{{ trans('management.picture') }}</th>
                                        <th>{{ trans('management.user') }}</th>
                                        <th>{{ trans('management.active') . ' | ' . trans('management.validated') }}</th>
                                        <th>{{ trans('management.actions') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($spaces as $space)
                                        <tr>
                                            <td>{{ $space->id }}</td>
                                            <td>{{ $space->name }}</td>
                                            @php
                                                $space_photos = $space->space_photos()->where("photo_type", "main")->get();
                                            @endphp
                                            @if(count($space_photos) > 0)
                                                <td><a href="{{ Storage::url($space_photos[0]->path) }}"><img class="logo_img" src="{{ Storage::url($space_photos[0]->path) }}"></a></td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{ $space->user->first_name . ' ' . $space->user->last_name }}</td>
                                            <td>{{ $space->active == 1 ? trans('management.yes') : trans('management.no')}}&nbsp;|&nbsp;{{$space->validated == 1 ? trans('management.yes') : trans('management.no') }}</td>
                                            <td>
                                                <form action="{{ route('spaces.destroy', $space) }}" method="POST">
                                                    <a href="{{ route('spaces.show', $space) }}" class="btn btn-primary" role="button">{{ trans('management.view') }}</a>
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

                                    @if ($spaces->lastPage() > 1)
                                        <ul class="pagination">
                                            <li class="{{ ($spaces->currentPage() == 1) ? ' disabled' : '' }}">
                                                <a href="{{ $spaces->url(1) }}">{{ trans('pagination.first') }}</a>
                                            </li>
                                            @for ($i = 1; $i <= $spaces->lastPage(); $i++)
                                                <?php
                                                $half_total_links = floor($link_limit / 2);
                                                $from = $spaces->currentPage() - $half_total_links;
                                                $to = $spaces->currentPage() + $half_total_links;
                                                if ($spaces->currentPage() < $half_total_links) {
                                                    $to += $half_total_links - $spaces->currentPage();
                                                }
                                                if ($spaces->lastPage() - $spaces->currentPage() < $half_total_links) {
                                                    $from -= $half_total_links - ($spaces->lastPage() - $spaces->currentPage()) - 1;
                                                }
                                                ?>
                                                @if ($from < $i && $i < $to)
                                                    <li class="{{ ($spaces->currentPage() == $i) ? ' active' : '' }}">
                                                        <a href="{{ $spaces->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor
                                            <li class="{{ ($spaces->currentPage() == $spaces->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $spaces->url($spaces->lastPage()) }}">{{ trans('pagination.last') }}</a>
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