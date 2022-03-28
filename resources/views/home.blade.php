@extends('layouts.app')
@section('page-title')
    Home
@endsection
@section('content')
    <div class="flex flex-col gap-24 md:gap-28 lg:gap-16">
        {{-- Hero Section --}}
        <section>
            <div class="flex flex-col-reverse lg:flex-row relative">
                {{-- Headings --}}
                <div class="container lg:w-5/12 lg:ml-20 relative">
                    @include('components.theBubbles')
                    <h1 class="text-xl text-center font-semibold lg:hidden">Premium Car Service in Iraq</h1>
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
                    <div class="mt-3 w-full flex items-center justify-center lg:justify-start">
                        <a href="{{ route('auth.register') }}"
                            class="btn btn-primary text-lg font-semibold z-10 transition">Start
                            Now</a>
                    </div>
                </div>
                {{-- Hero Image --}}
                <div class="flex flex-col items-center justify-center mb-3 lg:mb-0 lg:full lg:w-7/12 relative">
                    <img src="{{ asset('assets/imgs/bmw.png') }}" alt="bmw_img">
                </div>
            </div>
        </section>

        {{-- Brands --}}
        <section class="container">
            <div class="swiper homeSwiper">
                <div class="swiper-wrapper p-3">
                    @foreach (Storage::files('public/logos') as $car_brand)
                        <div class="flex justify-center p-3 rounded-lg bg-gray-50 swiper-slide shadow-sm">
                            <img src="{{ Storage::url($car_brand) }}" class="car-logo" alt="car_brand">
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
