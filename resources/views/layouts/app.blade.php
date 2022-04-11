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
    <div class="ds-drawer">
        <input id="ds-my-drawer-3" type="checkbox" class="ds-drawer-toggle">
        <div class="flex flex-col ds-drawer-content">
            <!-- Navbar -->
            <div class="w-full my-3 bg-white ds-navbar">
                <div class="flex-none lg:hidden">
                    <label for="ds-my-drawer-3" class="ds-btn ds-btn-square ds-btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" class="w-14 h-14 md:w-auto md:h-auto"
                            alt="logo" /></a>
                </div>
                <div class="flex-none hidden lg:block">
                    @include('components.theNavbar')
                </div>
                <div class="ml-2">
                    @auth
                        <livewire:the-nav-drop-down>
                        @endauth
                </div>
            </div>
            <main>
                @yield('content')
            </main>
            @if (!Route::is('map.*'))
                @include('components.theFooter')
            @endif
        </div>
        <div class="ds-drawer-side">
            <label for="ds-my-drawer-3" class="ds-drawer-overlay"></label>
            <!-- Sidebar content here -->
            <ul class="p-4 overflow-y-auto ds-menu w-80 bg-base-100">
                <!-- Sidebar content here -->
                <li>
                    <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" class="my-2"
                            alt="logo" /></a>

                </li>
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-3  {{ Route::is('home') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                        {{-- home icon --}}
                        <i class="w-5 h-5 ml-1 fas fa-home"></i>
                        <span class="mx-1">
                            Home
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('explore.show') }}"
                        class="flex items-center p-3  {{ Route::is('explore.show') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                        {{-- Browse icon --}}
                        <i class="w-5 h-5 ml-1 fas fa-car"></i>
                        <span class="mx-1">
                            Explore
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('map.show') }}"
                        class=" flex items-center p-3  {{ Route::is('map.show') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                        {{-- Map Icon --}}
                        <i class="w-5 h-5 ml-1 fas fa-map"></i>
                        <span class="mx-1">
                            Map
                        </span>
                    </a>
                </li>
                @if (Route::is('home'))
                    <li>
                        <button onclick="scrollToId('features-section')"
                            class="flex items-center p-3 capitalize transition duration-200 transform hover:bg-gray-100 ">
                            {{-- Features Icon --}}
                            <i class="w-5 h-5 ml-1 fas fa-cogs"></i>
                            <span class="mx-1">
                                Features
                            </span>
                        </button>
                    </li>
                    <li>
                        <button onclick="scrollToId('contact-us-section')"
                            class="flex items-center p-3 capitalize transition duration-200 transform hover:bg-gray-100 ">
                            {{-- Contact Icon --}}
                            <i class="w-5 h-5 ml-1 fas fa-phone"></i>
                            <span class="mx-1">
                                Contact Us
                            </span>
                        </button>
                    </li>
                @else
                    <li>
                        <a href="{{ route('spare_types.show') }}"
                            class="flex items-center p-3  {{ Route::is('spare_types.show') || Route::is('spare_part.show') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                            {{-- Spare Part Icon --}}
                            <i class="w-5 h-5 ml-1 fas fa-cogs"></i>
                            <span class="mx-1">
                                Spare Parts
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accessories.show') }}"
                            class="flex items-center p-3 {{ Route::is('accessories.show') || Route::is('accessory.show') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                            {{-- Accessory Icon --}}
                            <i class="w-5 h-5 ml-1 fas fa-tshirt"></i>
                            <span class="mx-1">
                                Accessories
                            </span>
                        </a>
                    </li>
                @endif


                @guest
                    <li>
                        <a href="{{ route('auth.login') }}" class="flex items-center gap-2 transition btn btn-secondary">
                            <span>Login</span>
                            <i class="text-sm fas fa-arrow-right"></i>
                        </a>
                    </li>
                @endguest
            </ul>

        </div>
    </div>

    @include('sweetalert::alert')
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
