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
    <title>
        @yield('page-title','Home') - M Cars
    </title>
</head>

<body class="min-h-screen font-Poppins">
    <!-- Header -->
    @if (!Route::is('auth.login') && !Route::is('auth.register'))
        <header class="m-5 lg:my-2">
            @include('components.theNavbar')
        </header>
    @endif
    <main>
        @yield('content')
    </main>
    @if (!Route::is('map.*'))
        @include('components.theFooter')
    @endif
    @include('sweetalert::alert')
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
