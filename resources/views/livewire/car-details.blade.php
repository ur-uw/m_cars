<div class="container">
    <!-- Image gallery -->
    @if ($car->images !== null && count($car->images) > 0)
        <div class="flex flex-col items-center container lg:flex-row">
            <div class="container">
                <img class="object-contain lg:h-96 min-w-full" src="{{ Storage::url($selected_car_image) }}"
                    alt="car_thumb_nail">
            </div>
            <div class="grid grid-cols-2 gap-3 mt-4 lg:m-0 lg:grid-cols-1">
                @foreach ($car->images as $img)
                    <div class="w-32 p-3 shadow overflow-hidden bg-gray-50 {{ $selected_car_image == $img ? 'border border-primary' : '' }} cursor-pointer hover:shadow-lg transition rounded"
                        wire:click='$set("selected_car_image","{{ $img }}")'>
                        <img class="min-h-full min-w-full object-cover" src="{{ Storage::url($img) }}" alt="car_image">
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="container">
            <img class="h-96 min-w-full object-contain" src="{{ Storage::url($car->thumb_nail) }}"
                alt="car_thumb_nail">
        </div>
    @endif

    <!-- Product info -->
    <div
        class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                {{ $car->manufacturer->name }} {{ $car->model }}
            </h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:mt-0 lg:row-span-3">
            <h2 class="sr-only">Product information</h2>
            <p class="text-3xl text-gray-900">${{ number_format($car->details->price, 3) }}</p>

            <!-- Reviews -->
            <div class="mt-6">
                <h3 class="sr-only">Reviews</h3>
                <div class="flex items-center">
                    <div class="flex items-center">

                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>


                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>


                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>


                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>


                        <svg class="text-gray-200 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="sr-only">4 out of 5 stars</p>
                    <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117
                        reviews</a>
                </div>
            </div>

            <form class="mt-10">
                <!-- Colors -->
                <div>
                    <h3 class="text-sm text-gray-900 font-medium">Color</h3>

                    <fieldset class="mt-4">
                        <legend class="sr-only">
                            Choose a color
                        </legend>
                        <div class="flex items-center space-x-3">

                            <label
                                class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
                                <input type="radio" name="color-choice" value="White" class="sr-only"
                                    aria-labelledby="color-choice-0-label">
                                <p id="color-choice-0-label" class="sr-only">
                                    White
                                </p>
                                <span aria-hidden="true"
                                    class="h-8 w-8 bg-white border border-black border-opacity-10 rounded-full"></span>
                            </label>


                            <label
                                class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-400">
                                <input type="radio" name="color-choice" value="Gray" class="sr-only"
                                    aria-labelledby="color-choice-1-label">
                                <p id="color-choice-1-label" class="sr-only">
                                    Gray
                                </p>
                                <span aria-hidden="true"
                                    class="h-8 w-8 bg-gray-200 border border-black border-opacity-10 rounded-full"></span>
                            </label>


                            <label
                                class="-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none ring-gray-900">
                                <input type="radio" name="color-choice" value="Black" class="sr-only"
                                    aria-labelledby="color-choice-2-label">
                                <p id="color-choice-2-label" class="sr-only">
                                    Black
                                </p>
                                <span aria-hidden="true"
                                    class="h-8 w-8 bg-gray-900 border border-black border-opacity-10 rounded-full"></span>
                            </label>
                        </div>
                    </fieldset>
                </div>
                @if (!$car->user)
                    <button type="submit"
                        class="mt-10 w-full bg-primary border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add
                        to garage</button>
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
                    <ul role="list" class="pl-4 list-disc text-sm space-y-2">
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
                <h2 class="text-sm font-medium text-gray-900">Details</h2>

                <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-4 sm:gap-y-16 lg:gap-x-8">

                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Fuel Type</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->fuel_type }}</dd>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Fuel Economy</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->fuel_economy }}</dd>
                    </div>


                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Driving Mode</dt>
                        <dd class="mt-2 text-sm text-gray-500 capitalize">{{ $car->details->driving_mode }}</dd>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Number of Cylinders</dt>
                        <dd class="mt-2 text-sm text-gray-500">
                            {{ $car->details->number_of_cylinders }}
                        </dd>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Gearbox Speeds</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->gearbox_speeds }}</dd>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Production Year</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->manufactured_at }}</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Seating Capacity</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->seating_capacity }}</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <dt class="font-medium text-gray-900">Seating Capacity</dt>
                        <dd class="mt-2 text-sm text-gray-500">{{ $car->details->plate_number }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
</div>
