<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>New Space Booking</title>
    </head>
    <body>
        <h2>{{ 'Space Booking ID: ' . $space_booking->id }}</h2>
        <h2>{{ 'Space: ' }} <a href="{{ url('/space-details', $space_booking->space->id) }}">{{ 'ID: ' . $space_booking->space->id . ' Name: ' . $space_booking->space->name}}</a></h2>
        <h2>{{ 'Customer: ' . $space_booking->user->first_name . ' ' . $space_booking->user->last_name }}</h2>
        <h2>{{ 'Price: ' . $space_booking->price_unit * $space_booking->duration . ' ' . $space_booking->currency }}</h2>
        <h2>{{ 'Period: ' .$space_booking->start_datetime}} &mdash; {{ $space_booking->end_datetime }} </h2>
        <h2>{{ 'Plan Type: ' . $space_booking->space_price_plan }}</h2>
        <h2>{{ 'Date Reservation: ' . $space_booking->date_reservation }}</h2>
    </body>
</html>