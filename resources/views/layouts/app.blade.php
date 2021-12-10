<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/fav_icon/car_logo.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('styles')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    <title>M Cars</title>
</head>

<body class="font-Poppins">
    <!-- Header -->
    @if (Route::currentRouteName() != 'auth.login' && Route::currentRouteName() != 'auth.register')
        <header class="container mb-5">
            @include('components.theNavbar')
        </header>
    @endif
    <main>
        @yield('content')
    </main>
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
