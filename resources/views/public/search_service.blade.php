@extends('public.layouts.master')

@section('head')
    <head>
        <title>Spaces and Services</title>

        @include('public.layouts.styles')
        <link href="css/home_page.css" rel="stylesheet">
    </head>
@endsection

@section('content')
@endsection

@section('footer')
    @include('public.layouts.footer')
@endsection

@section('google-maps-scripts')
    @include('public.layouts.google-maps-scripts')
@endsection

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh_y634oRbkYzDn9r8PuJT_Rk4azff1ao&libraries=places&callback=completeCityName" async defer></script>
<script src="js/autocomplete.js"></script>
