@extends('layouts.app')
@section('styles')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
@section('content')
    {{-- Hero Section --}}
    <section>
        <div class="flex flex-col-reverse lg:flex-row relative">
            {{-- Headings --}}
            <div class="container lg:w-5/12 lg:ml-20 relative">
                <div
                    class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                </div>
                <div
                    class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                </div>
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
                <div class="mt-3 w-full flex items-center">
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
    <section class="container mt-16">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                {{-- <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/tesla_logo.png') }}" class="h-100 w-100" alt="tesla_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/toyota_logo.png') }}" class="h-100 w-100" alt="toyota_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/ford_logo.png') }}" class="h-100 w-100" alt="ford_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/ferrari_logo.png') }}" class="h-100 w-100"
                        alt="ferrari_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/jeep_logo.png') }}" class="h-100 w-100" alt="jeep_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/audi_logo.png') }}" class="h-100 w-100" alt="audi_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/lamborghini_logo.png') }}" class="h-100 w-100"
                        alt="lamborghini_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/bmw_logo.png') }}" class="h-100 w-100" alt="bmw_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/porsche_logo.png') }}" class="h-100 w-100"
                        alt="porsche_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/mercedes_logo.png') }}" class="h-100 w-100"
                        alt="mercedes_logo">
                </div>
                <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                    <img src="{{ asset('assets/imgs/logos/lexus_logo.png') }}" class="h-100 w-100" alt="lexus_logo">
                </div> --}}
                @foreach (Storage::files('public/logos') as $car_brand)
                    <div class="h-24 w-24 flex justify-center p-3 rouneded-lg bg-gray-50 swiper-slide  ">
                        <img src="{{ Storage::url($car_brand) }}" class="h-100 w-100" alt="car_brand">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            freeMode: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 8,
                    spaceBetween: 30,
                }
            }
        });
    </script>
@endsection
