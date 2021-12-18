<div
    class="flex flex-col rounded-xl h-full w-full  shadow px-5 py-6 overflow-hidden transition hover:shadow-lg cursor-pointer relative">
    @if (\Carbon\Carbon::parse($car->details->manufactured_at)->year >= now()->year)
        <div
            class="absolute bg-secondary border border-white border-dashed text-white text-xs p-1 rounded-xl h-15 w-15 top-2 right-3">
            New
        </div>
    @endif
    <a href="{{ route('car_details.show') }}" class="hover:text-primary transition">
        {{-- Car name and year --}}
        <div>
            <h3 class="lg:text-lg font-semibold">{{ $car->manufacturer->name }} {{ $car->model }}</h3>
            {{-- Car year --}}
            <h3>
                {{ \Carbon\Carbon::parse($car->details->manufactured_at)->year }}
            </h3>
        </div>
        {{-- Car image --}}
        <div class="flex-1 h-full w-full">
            <img class="max-h-full max-w-full object-contain" src="{{ Storage::url($car->thumb_nail) }}"
                alt="car_image">
        </div>
    </a>
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
