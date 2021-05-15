<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Welcome to ICW Plataform</title>
    </head>
    <body>
        <h1>Welcome to ICW Plataform: {{ $user->first_name . ' ' . $user->last_name }}</h1>
        <a href="{{ route('confirmEmail', $user->remember_token) }}">Link to activate account</a>
    </body>
</html>