@extends('layouts.app')
@section('page-title')
    Home
@endsection
@section('content')
    <div class="flex flex-col gap-24 md:gap-28 lg:gap-16">
        {{-- Hero Section --}}
        <section>
            <div class="relative flex flex-col-reverse lg:flex-row">
                {{-- Headings --}}
                <div class="container relative lg:w-5/12 lg:ml-20">
                    @include('components.theBubbles')
                    <h1 class="text-xl font-semibold text-center lg:hidden">Premium Car Service in Iraq</h1>
                    <div class="hidden lg:flex lg:flex-col lg:text-7xl lg:font-bold">
                        <span>Premium</span>
                        <span>Car Services</span>
                        <span>in Iraq</span>
                    </div>
                    <p class="mt-3 text-center lg:text-lg lg:mt-5 lg:w-5/6 lg:text-justify">
                        Don't deny your self the pleasure of
                        using
                        best
                        premium services
                        from around
                        the world with our modern versatile tool for car's management, maintenance and information
                        here and now.
                    </p>
                    {{-- Call to action --}}
                    <div class="flex items-center justify-center w-full mt-3 lg:justify-start">
                        <a href="{{ route('auth.register') }}"
                            class="z-10 text-lg font-semibold transition btn btn-primary">Start
                            Now</a>
                    </div>
                </div>
                {{-- Hero Image --}}
                <div class="relative flex flex-col items-center justify-center mb-3 lg:mb-0 lg:full lg:w-7/12">
                    <img src="{{ asset('assets/imgs/bmw.png') }}" alt="bmw_img">
                </div>
            </div>
        </section>

        {{-- Brands --}}
        <section class="container">
            <div class="swiper homeSwiper">
                <div class="p-3 swiper-wrapper">
                    @foreach ($logos as $car_brand)
                        <div class="flex justify-center p-3 rounded-lg shadow-sm bg-gray-50 swiper-slide">
                            <img src='{{ asset('assets/imgs/logos/' . $car_brand->getFilename()) }}'
                                class="car-logo" alt="{{ $car_brand->getFilenameWithoutExtension() }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- Features --}}
        @include('components.theFeatures')
        {{-- Contact Us --}}
        @include('components.theContactUs')
    </div>
@endsection
