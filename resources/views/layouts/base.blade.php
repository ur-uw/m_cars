<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/fav_icon/car_logo.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>M Cars</title>
</head>

<body>

    <!-- Header -->
    @if (Route::currentRouteName() != 'auth.login' && Route::currentRouteName() != 'auth.register')
        <header>
            <nav class="flex items-center p-3 flex-wrap">
                <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" alt="logo" /></a>
                <div class="inline-flex p-3  rounded lg:hidden ml-auto outline-none">
                    <i class="
                    fas fa-bars text-2xl text-black" id="menu"></i>
                </div>
                <div class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto" id="navigation">
                    <ul
                        class="bg-gray-50 lg:bg-white p-5 flex flex-col gap-6 lg:gap-12 lg:flex-row  ml-auto lg:items-center">
                        <a href="#" class="hover:text-primary transition">Features</a>
                        <a href="#" class="hover:text-primary transition">Pricing</a>
                        <a href="#" class="hover:text-primary transition">Contact</a>
                        @if (!Auth::check())
                            <li class="md:flex gap-x-2">
                                <a href="{{ route('auth.login') }}"
                                    class="border border-secondary text-secondary py-2 px-6 rounded-md uppercase">
                                    Login
                                </a>
                                <a href="{{ route('auth.register') }}"
                                    class="bg-secondary text-white py-2 px-6 rounded-md uppercase">
                                    Register
                                </a>
                            </li>
                        @else
                            @if (Route::currentRouteName() == 'dashboard.show')
                                <a href="{{ route('auth.logout') }}"
                                    class="bg-secondary text-sm md:text-md text-white text-center py-2 block px-6 rounded-md uppercase">
                                    Log out
                                </a>
                            @else
                                <a href="{{ route('dashboard.show') }}"
                                    class="text-sm capitalize text-secondary">{{ Auth::user()->name }}</a>
                            @endif
                        @endif
                    </ul>
                </div>
            </nav>
            <nav>

            </nav>



        </header>
    @endif

    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
