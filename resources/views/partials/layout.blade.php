<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking App</title>
        @include('partials.styles')
        <style>
            .text-danger {
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        @yield('content')
        @include('partials.scripts')
    </body>
</html>
