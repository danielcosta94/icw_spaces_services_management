<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Request of Informations to Space</title>
    </head>
    <body>
        <h1>Request of Informations to Space: <a href="{{ url('/space-details', $space->id) }}">{{ 'ID: ' . $space->id . ' Name: ' . $space->name}}</a></h1>
        <h2>{{ 'User: ' . $user->first_name . ' ' . $user->last_name}}</h2>
        <h2>{{ 'Email: ' . $user->email }}</h2>
        <p>{{ $description }}</p>
    </body>
</html>