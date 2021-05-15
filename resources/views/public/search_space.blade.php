@extends('public.layouts.master')

@section('head')
    <head>
        <title>Spaces and Services</title>

        @include('public.layouts.styles')
        <link href="css/home_page.css" rel="stylesheet">
    </head>
@endsection

@section('content')
    <div>
        @php
            use App\Models\Space;
            use App\Models\SpaceType;
            use Illuminate\Support\Facades\Input;

            $city = Input::get('city', null);
            $space_type_id = Input::get('space_type');

            $spaces = Space::getAllVisibleSpaces($space_type_id)->paginate(10);
            $space_types = SpaceType::all();
        @endphp

        <div class="container-fluid row abo">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="form_search" class="padding-bottom-text" action="{{ route('search_space') }}" role="form" method="GET">
                            <h4 class="main-menu-txt">{{ trans('search.search_space') }}</h4>

                            <div class="padding-bottom-text">
                                <input id="city" name="city" type="text" value="{{ $city }}" placeholder="{{ trans('register.city') }}" class="form-control">
                            </div>

                            <div class="padding-bottom-text">
                                <select id="space_type" name="space_type" class="form-control">
                                    @if($space_type_id != 'all')
                                        <option value="all">{{ trans('search.spaces_types_all') }}</option>

                                        @foreach($space_types as $space_type)
                                            @if($space_type_id != $space_type->id)
                                                <option value="{{ $space_type->id }}">{{$space_type->space_type}}</option>
                                            @else
                                                <option value="{{ $space_type->id }}" selected>{{$space_type->space_type}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="all" selected>{{ trans('search.spaces_types_all') }}</option>

                                        @foreach($space_types as $space_type)
                                            <option value="{{$space_type->id}}">{{$space_type->space_type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('search.search') }}</button>
                            </div>
                        </form>

                        <section class="google-map">
                            <div class="container-fluid padding-fix wow fadeInUp">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="property-map"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection

@section('google-maps-scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=completeCitiesName" async defer></script>
    <script src=" {{ asset('js/autocomplete.js') }}"></script>
    <script src={{ asset('js/google-map-spaces-search.js')}} async defer></script>
@endsection