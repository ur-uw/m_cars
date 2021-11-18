<div class="container">
    {{-- Search --}}
    <section class="container">
        <div class="mx-auto lg:w-3/4 flex items-center shadow px-6 py-4 gap-3 rounded-full">
            <i class="fas fa-search text-2xl text-primary"></i>
            <span class="flex-1">
                <input wire:model='term' class=" border-0 w-full" type="text" placeholder="Ex: Mercedes Benz,...">
            </span>
            <span>
                <button class="hidden lg:block btn btn-primary transition">
                    Search
                </button>
            </span>
        </div>
    </section>
    <section class=" mt-16">

        {{-- Heading and Filters --}}
        <div class="flex flex-col lg:flex-row items-start justify-between gap-2">
            <div>
                <h1 class="text-xl lg:text-2xl font-semibold">Car Catalogue</h1>
                <p class="text-sm">Explore out cars you might like!</p>
            </div>
            <div class="flex justify-center items-center w-full flex-col lg:w-1/2 md:flex-row  gap-3">
                <div class="flex items-center w-full lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="manufacturer" class="flex-1">Manufacturer</label>
                    <select id="manufacturer" class="flex-1" wire:model='filterManufacturer'
                        class="text-sm">
                        <option value="">All</option>
                        @foreach ($manufacturers as $man)
                            <option value="{{ $man->id }}">{{ $man->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full items-center lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="type" class="flex-1">Type</label>
                    <select id="type" class="flex-1" wire:model="filterType" class="text-sm">
                        <option value="">All</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full items-center lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="rating" class="flex-1">Rating</label>
                    <select id="rating" class="flex-1" class="text-sm">
                        <option value="">All</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </section>
    {{-- Cars --}}
    @if (count($cars) > 0)
        <div class="mt-6 grid grid-cols-1 gap-3 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                {{-- Car card --}}
                <div class="flex flex-col rounded-xl  h-72 md:h-auto lg:h-72  shadow px-5 py-6 overflow-hidden lg:w-15">
                    <h3 class="lg:text-lg font-semibold">{{ $car->manufacturer->name }} {{ $car->model }}</h3>
                    {{-- Car year --}}
                    <h3>
                        {{ \Carbon\Carbon::parse($car->details->manufactured_at)->year }}
                    </h3>
                    {{-- Car image --}}
                    <div class="w-full h-full flex flex-col items-center justify-center lg:mt-3 ">
                        <img src="{{ asset('assets/imgs/bmw.png') }}" alt="">
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5" src="{{ asset('assets/svg/steering_wheel.svg') }}"
                                alt="steering_wheel">
                            <h4 class="text-sm capitalize">{{ $car->details->driving_mode }}</h4>
                        </span>
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5"
                                src="https://img.icons8.com/ios-filled/50/000000/car-seat.png" />
                            <h4 class="text-sm">{{ $car->details->seating_capacity }}</h4>
                        </span>
                        <span class="flex flex-col items-center">
                            <img class="h-5 w-5"
                                src="https://img.icons8.com/ios-filled/50/000000/gas-station.png" />
                            <h4 class="text-sm">{{ $car->details->tank_capacity }} MPG</h4>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-6">
            {{ $cars->links() }}
        </div>
    @else
        <h3 class="text-lg font-semibold lg:text-2xl text-primary mt-6">No Cars!</h3>
    @endif
</div>
