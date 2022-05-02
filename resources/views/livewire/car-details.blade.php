@section('page-title')
    Car Details
@endsection
<div class="container">
    <!-- Image gallery -->
    @if ($car->images !== null && count($car->images) > 0)
        <div class="container flex flex-col items-center lg:flex-row">
            <div class="container">
                <img class="object-contain min-w-full lg:h-96"
                    src="{{ $useRealData ? $selected_car_image : Storage::url($selected_car_image) }}"
                    alt="car_thumb_nail">
            </div>
            <div class="grid grid-cols-2 gap-3 mt-4 lg:m-0 lg:grid-cols-1">
                @foreach ($car->images as $img)
                    <div class="w-32 p-3 shadow overflow-hidden bg-gray-50 {{ $selected_car_image == $img ? 'border border-primary' : '' }} cursor-pointer hover:shadow-lg transition rounded"
                        wire:click='$set("selected_car_image","{{ $img }}")'>
                        <img class="object-cover min-w-full min-h-full"
                            src="{{ $useRealData ? $img : Storage::url($img) }}" alt="car_image">
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="container">
            <img class="object-contain min-w-full h-96"
                src="{{ $useRealData ? $car->thumb_nail : Storage::url($car->thumb_nail) }}" alt="car_thumb_nail">
        </div>
    @endif

    <!-- Product info -->
    <div
        class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 capitalize sm:text-3xl">
                {{ $car->manufacturer->name }} {{ $car->model }}
            </h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:mt-0 lg:row-span-3">
            <h2 class="sr-only">Product information</h2>
            <p class="text-3xl text-gray-900">${{ number_format($car->details->price, 0) }}</p>



            <form class="mt-10" wire:submit.prevent>
                @if ($showAddToGarage)
                    <button type="button" wire:click='addToGarage'
                        class="flex items-center justify-center w-full px-8 py-3 mt-10 text-base font-medium text-white border border-transparent rounded-md bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add to garage
                    </button>
                @endif
            </form>
        </div>

        <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <!-- Description and details -->
            <div>
                <h3 class="sr-only">Description</h3>

                <div class="space-y-6">
                    <p class="text-base text-gray-900">{{ $car->details->description }}</p>
                </div>
            </div>

            <div class="mt-10">
                <h3 class="text-sm font-medium text-gray-900">Specifications</h3>

                <div class="mt-4">
                    <ul role="list" class="pl-4 space-y-2 text-sm list-disc">
                        <li class="text-gray-400"><span class="text-gray-600">

                                @if ($car->details->fuel_type == 'electricity')
                                    Battery Capacity:
                                    {{ $car->details->battery_capacity }}
                                    A
                                @else
                                    Tank Capacity:
                                    {{ $car->details->tank_capacity }}
                                    L
                                @endif
                            </span>
                        </li>

                        <li class="text-gray-400"><span class="text-gray-600">
                                Top Speed: {{ $car->details->top_speed }} KM/H</span></li>

                        <li class="text-gray-400"><span class="text-gray-600">Acceleration:
                                {{ $car->details->acceleration }} seconds</span>
                        </li>

                        <li class="text-gray-400"><span class="text-gray-600">Engine Capacity:
                                {{ $car->details->engine_capacity }}
                            </span></li>
                    </ul>
                </div>
            </div>

            <div class="mt-10">
                <div class="flex justify-between item-center">
                    <h2 class="text-sm font-medium text-gray-900">Details</h2>
                    <span class="text-xs font-normal">See
                        <a href="{{ route('car_products.show', ['manufacturer_name' => \Str::snake($car->manufacturer->name),'type' => 'Spare Parts','model' => \Str::snake($car->model)]) }}"
                            class="transition text-primary hover:underline">Spare parts</a> |
                        <a href="{{ route('car_products.show', ['manufacturer_name' => \Str::snake($car->manufacturer->name),'type' => 'accessories','model' => \Str::snake($car->model)]) }}"
                            class="transition text-primary hover:underline">
                            Accessories
                        </a>
                        for this car
                    </span>
                </div>
                <dl class="grid grid-cols-1 mt-16 gap-x-6 gap-y-10 sm:grid-cols-4 sm:gap-y-16 lg:gap-x-8">

                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Fuel Type</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->fuel_type }}</dd>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Fuel Economy</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->fuel_economy }}</dd>
                    </div>


                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Driving Mode</dt>
                        <dd class="mt-2 text-sm text-gray-500 capitalize">{{ $car->details->driving_mode }}</dd>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Number of Cylinders</dt>
                        <dd class="mt-2 text-sm text-gray-500">
                            {{ $car->details->number_of_cylinders }}
                        </dd>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Gearbox Speeds</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->gearbox_speeds }}</dd>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Production Year</dt>
                        <dd class="mt-2 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($car->details->manufactured_at)->year }}
                        </dd>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Seating Capacity</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->seating_capacity }}</dd>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <dt class="font-medium text-gray-900">Plate Number</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->plate_number }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
