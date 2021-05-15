@extends('public.layouts.master')

@section('head')
    <head>
        <title>Spaces and Services</title>

        @include('public.layouts.styles')
    </head>
@endsection

@section('content')
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">
        </div>
    </div>
    <!-- =========================
        Search Form
        ============================== -->
    <section class="container-image-background">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home_page_content">
                        <div class="text-center">
                            <h2 class="welcome-text">{{ trans('index.welcome_message') }}</h2>
                        </div>

                        <div class="col-sm-6">
                            <h3 class="main-menu-txt">{{ trans('search.search_space') }}</h3>

                            <form id="form_search" action="{{ route('search_space') }}" role="form" method="GET">
                                <div>
                                    <input name="city" type="text" placeholder="{{ trans('register.city') }}" class="form-control">
                                </div>

                                <div class="padding-bottom-text">
                                    <select id="space_type" name="space_type" class="form-control">
                                        @php
                                            $space_types = \App\Models\SpaceType::all();
                                        @endphp
                                        <option value="all">{{ trans('search.spaces_types_all') }}</option>
                                        @foreach($space_types as $space_type)
                                            <option value="{{$space_type->id}}">{{$space_type->space_type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ trans('search.search') }}</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-6">
                            <h3 class="main-menu-txt">{{ trans('search.search_service') }}</h3>

                            <form id="form_search" action="{{ route('search_service') }}" role="form" method="GET">
                                <div>
                                    <input id="service_name" name="service_name" type="text" placeholder="{{ trans('search.what') }}" class="form-control">
                                </div>

                                <div>
                                    <input name="city" type="text" placeholder="{{ trans('register.city') }}" class="form-control">
                                </div>

                                <div class="padding-bottom-text">
                                    <select id="service_type" name="service_type" class="form-control">
                                        @php
                                            $business_vericals = \App\Models\BusinessVertical::all();
                                        @endphp
                                        <option value="all_services">{{ trans('search.services_types_all') }}</option>
                                        @foreach($business_vericals as $business_verical)
                                            <option value="{{$business_verical->id}}">{{$business_verical->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ trans('search.search') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection

@section('google-maps-scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=completeCitiesName" async defer></script>
    <script src=" {{ asset('js/autocomplete.js') }}"></script>
@endsection

