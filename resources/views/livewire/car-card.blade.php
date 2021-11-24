<div>
    <div class="flex flex-col rounded-xl  h-72 md:h-auto lg:h-72  shadow px-5 py-6 overflow-hidden lg:w-15">
        {{-- Car name and year --}}
        <div>
            <h3 class="lg:text-lg font-semibold">{{ $car->manufacturer->name }} {{ $car->model }}</h3>
            {{-- Car year --}}
            <h3>
                {{ \Carbon\Carbon::parse($car->details->manufactured_at)->year }}
            </h3>
        </div>
        {{-- Car image --}}
        <div class="flex-1">
            <img class="w-full h-full object-contain" src="{{ Storage::url($car->thumb_nail) }}" alt="car_image">
        </div>
        {{-- Car Specifications --}}
        <div class="flex items-end justify-between px-3 mt-3">
            <span class="flex flex-col items-center">
                <img class="h-5 w-5" src="{{ asset('assets/svg/steering_wheel.svg') }}" alt="steering_wheel">
                <h4 class="text-sm capitalize">{{ $car->details->driving_mode }}</h4>
            </span>
            <span class="flex flex-col items-center">
                <img class="h-5 w-5" src="https://img.icons8.com/ios-filled/50/000000/car-seat.png" />
                <h4 class="text-sm">{{ $car->details->seating_capacity }}</h4>
            </span>
            <span class="flex flex-col items-center">
                <img class="h-5 w-5" src="https://img.icons8.com/ios-filled/50/000000/gas-station.png" />
                <h4 class="text-sm">{{ $car->details->tank_capacity }} MPG</h4>
            </span>
        </div>
    </div>
</div>
