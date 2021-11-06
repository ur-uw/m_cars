@extends('layouts.app')
@section('content')
    {{-- Search --}}
    <section class="container">
        <div class="mx-auto lg:w-3/4 flex items-center shadow px-6 py-4 gap-3 rounded-full">
            <i class="fas fa-search text-2xl text-primary"></i>
            <span class="flex-1">
                <input class=" border-0 w-full" type="text" placeholder="Ex: Mercedes Benz,...">
            </span>
            <span>
                <button class="hidden lg:block btn btn-primary transition">
                    Search
                </button>
            </span>
        </div>
    </section>

    {{-- Car Categories --}}
    <section class="container mt-16">
        {{-- Heading and Filters --}}
        <div class="flex flex-col lg:flex-row items-start justify-between gap-2">
            <div>
                <h1 class="text-xl lg:text-2xl font-semibold">Car Catalogue</h1>
                <p class="text-sm">Explore out cars you might like!</p>
            </div>
            <div class="flex justify-center items-center w-full flex-col lg:w-1/2 lg:flex-row  gap-3">
                <select class="text-sm">
                    <option value="">Name</option>
                </select>
                <select class="text-sm">
                    <option value="">Manufacturer</option>
                </select>
                <select class="text-sm">
                    <option value="">Type</option>
                </select>
                <select class="text-sm">
                    <option value="">Rating</option>
                </select>
            </div>

        </div>
        {{-- Cars --}}
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-5 gap-3">
            @foreach ($cars as $car)
                {{-- Car card --}}
                <div class="flex flex-col rounded-xl bg-gray-100 h-72 lg:w-15  shadow px-5 py-6 overflow-hidden">
                    <h3 class="lg:text-lg font-semibold">{{ $car->manufacturer }} {{ $car->model }}</h3>
                    {{-- Car year --}}
                    <h3>
                        {{ \Carbon\Carbon::parse($car->manufactured_at)->year }}
                    </h3>
                    {{-- Car image --}}
                    <div class="w-full h-full flex flex-col items-center justify-center lg:mt-3 ">
                        <img src="{{ asset('assets/imgs/bmw.png') }}" alt="">
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5" src="{{ asset('assets/svg/steering_wheel.svg') }}"
                                alt="steering_wheel">
                            <h4 class="text-sm font-medium">Manual</h4>
                        </span>
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5" src="https://img.icons8.com/ios-filled/50/000000/car-seat.png" />
                            <h4 class="text-sm font-medium">4 Seats</h4>
                        </span>
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5" src="https://img.icons8.com/ios-filled/50/000000/gas-station.png" />
                            <h4 class="text-sm font-medium">34 MPG</h4>
                        </span>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
