<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@yield('head')

<body>

@yield('content')

<!-- =========================
    SCRIPTS
============================== -->
@include('auth.layouts.scripts-man')

@yield('extra-scripts')

</body>
</html>