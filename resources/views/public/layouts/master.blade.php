<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@yield('head')

<body>

<!-- =========================
    Header Section
============================== -->

@include('public.layouts.header')
<!-- =========================
   Navigation Section
============================== -->

@include('public.layouts.nav-main')

@yield('content')

<!-- =========================
FOOTER
============================== -->
@yield('footer')

<!-- =========================
    SCRIPTS
============================== -->
@include('public.layouts.scripts')

@yield('google-maps-scripts')

@yield('extra-scripts')

</body>
</html>