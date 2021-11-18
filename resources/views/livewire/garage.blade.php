<div class="container">
    <section class="flex flex-col justify-center lg:flex-row lg:items-center lg:justify-between">
        {{-- Search --}}
        <div class="flex items-center py-4 gap-3 lg:w-1/2  ">
            <span class="flex-1">
                <label for="search">Search</label>
                <input id="search" wire:model='term' class="w-full" type="text"
                    placeholder="Ex: Mercedes Benz,...">
            </span>
        </div>
        {{-- Add car button --}}
        <a href="#" class="btn btn-primary flex items-center justify-between transition">
            <span>Add Car</span>
            <i class="fas fa-plus ml-2"></i>
        </a>
    </section>
    {{-- Cars --}}
    @if (count($cars) > 0)
        <div class="mt-6 grid grid-cols-1 gap-3 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                {{-- Car card --}}
                <div class="flex flex-col rounded-xl  h-72 lg:w-15  shadow px-5 py-6 overflow-hidden">
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
