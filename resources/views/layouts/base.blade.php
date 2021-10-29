<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/fav_icon/car_logo.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>M Cars</title>
</head>

<body>

    @if (Route::currentRouteName() != 'auth.login' && Route::currentRouteName() != 'auth.register')
        <a href="{{ route('auth.login') }}">Login</a>
        <a href="{{ route('auth.register') }}">Register</a>
    @endif
    @yield('content')
</body>

</html>
