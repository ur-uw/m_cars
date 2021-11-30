<div>
    <div class="flex items-center justify-center gap-3 mb-3">
        {{-- Step indicators --}}
        @for ($i = 0; $i < count($pages); $i++)
            <button type='button'
                class="rounded-full cursor-pointer bg-{{ $currentPage == $i ? 'primary' : 'app-grey' }}  h-2 w-2"
                wire:click='setPage({{ $i }})'>
            </button>
        @endfor
    </div>
    <h1 class="text-lg text-center font-semibold lg:font-bold lg:text-4xl">{{ $pages[$currentPage]['heading'] }}</h1>
    <form wire:submit.prevent='submit' class="container space-y-7 py-5 px-16 lg:px-28">
        @if ($currentPage == 0)
            {{-- First step --}}
            <div class="flex flex-col md:flex-row items-center gap-3">
                <div class="lg:flex-1">
                    <label for="model" class="text-xs lg:text-md lg:font-medium">Model Name</label>
                    <input id="model" wire:model.debounce='model' name="model" type="text">
                    <p class="text-app-grey text-xs mt-1">Do not exceed 20 characters when entering model name!
                    </p>
                    @error('model')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="color" class="text-xs lg:text-md lg:font-medium">Car Color</label>
                    <input id="color" type="text" name="color" wire:model.debounce='color'>
                    <p class="text-app-grey text-xs mt-1">Enter color name in hex format!</p>
                    @error('color')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="flex flex-col gap-3 md:flex-row lg:items-center ">
                    <div class="lg:w-1/4">
                        <label for="manufacturer" class="text-xs lg:text-md lg:font-medium">Manufacturer</label>
                        <select wire:model.lazy='manufacturer' name="manufacturer" id="manufacturer">
                            <option value="">Select</option>
                            @foreach ($manufacturers as $man)
                                <option value="{{ $man->id }}">{{ $man->name }}</option>
                            @endforeach
                        </select>
                        @error('manufacturer')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="lg:w-1/4">
                        <label for="type" class="text-xs lg:text-md lg:font-medium">Car Type</label>
                        <select name="type" id="type" name="type" wire:model.lazy='type'>
                            <option value="">Select</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="lg:w-1/2">
                        <label for="plate_number" class="text-xs lg:text-md lg:font-medium">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number" wire:model.debounce='plate_number' />
                        @error('plate_number')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Manufacturer and Date --}}
            <div class="flex flex-col md:flex-row items-center gap-3">
                <div class="lg:flex-1">
                    <label for="manufactured_at" class="text-xs lg:text-md lg:font-medium">Manufacture Date</label>
                    {{-- TODO: make custom date picker --}}
                    <input type="date" name="manufactured_at" id="manufactured_at" wire:model.lazy='manufactured_at'>
                    @error('manufactured_at')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="price" class="text-xs lg:text-md lg:font-medium">Price <sub
                            class="text-xs">($)</sub></label>
                    <input type="number" name="price" id="price" wire:model.debounce="price">
                    @error('price')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
            {{-- Description --}}
            <div>
                <label for="description" class="text-xs lg:text-md lg:font-medium">Description</label>
                <textarea name="description" id="description" cols="20" rows="5"
                    wire:model.debounce='description'></textarea>
                <p class=" text-app-grey text-xs mt-1">Do not exceed 20 characters when entering car description!
                </p>
                @error('description')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- Second step --}}
        @elseif ($currentPage==1)
            {{-- Fuel Details --}}
            <h2 class="text-md lg:text-2xl lg:font-semibold">Fuel Details</h2>
            <div>
                <div class="flex flex-col md:flex-row lg:items-center gap-3">
                    <div>
                        <label for="fuel_type" class="text-xs lg:text-md lg:font-medium">Fuel Type</label>
                        <select name="fuel_type" wire:model.lazy='fuel_type' id="fuel_type">
                            <option value="">Select</option>
                            {{-- TODO: add fuel types to database --}}
                            <option value="benzin">Benzin</option>
                            <option value="gas">Gas</option>
                            <option value="gasoline">Gasoline</option>
                            <option value="electricity">Electricity</option>
                        </select>
                        @error('fuel_type')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        @if ($fuel_type == 'electricity')
                            <label for="battery_capacity" class="text-xs lg:text-md lg:font-medium">Battery
                                Capacity</label>
                            <input type="number" id="battery_capacity" name="battery_capacity"
                                wire:model.debounce='battery_capacity'>
                            @error('battery_capacity')
                                <p class="error">
                                    {{ $message }}
                                </p>
                            @enderror
                        @else
                            <label for="tank_capacity" class="text-xs lg:text-md lg:font-medium">Tank Capacity</label>
                            <input type="number" id="tank_capacity" name="tank_capacity"
                                wire:model.debounce='tank_capacity'>
                            @error('tank_capacity')
                                <p class="error">
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="fuel_economy" class="text-xs lg:text-md lg:font-medium">
                            Fuel Economy
                            <sub class="text-xs">
                                @if ($fuel_type == 'electricity')
                                    A/L
                                @else
                                    Km/L
                                @endif
                            </sub>
                        </label>
                        <input type="number" id="fuel_economy" name="fuel_economy" wire:model.debounce='fuel_economy'>
                        @error('fuel_economy')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>
            {{-- Speed & Engine Details --}}
            <div class="h-px w-full shadow"></div>
            <h2 class="text-md lg:text-2xl lg:font-semibold">Speed & Engine Details</h2>
            <div class="flex flex-col md:flex-row lg:items-center gap-3">
                <div>
                    <label for="top_speed" class="text-xs lg:text-md lg:font-medium">
                        Top Speed
                        <sub class="text-xs">Km/H</sub>
                    </label>
                    <input type="number" id="top_speed" name="top_speed" wire:model.debounce='top_speed'>
                    @error('top_speed')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="acceleration" class="text-xs lg:text-md lg:font-medium">
                        Acceleration
                        <sub class="text-xs">Time from 0 to 100 Km</sub>
                    </label>
                    <input type="number" id="acceleration" name="acceleration" wire:model.debounce='acceleration'>
                    @error('acceleration')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="gearbox_speeds" class="text-xs lg:text-md lg:font-medium">
                        Gearbox Speeds
                    </label>
                    <input type="number" id="gearbox_speeds" name="gearbox_speeds" wire:model.debounce='gearbox_speeds'>
                    @error('gearbox_speeds')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            {{-- Engine Details --}}
            <div class="flex flex-col md:flex-row lg:items-center gap-3">
                <div class="lg:flex-1">
                    <label for="engine_capacity" class="text-xs lg:text-md lg:font-medium">
                        Engine Capacity
                    </label>
                    <input type="number" id="engine_capacity" name="engine_capacity"
                        wire:model.debounce='engine_capacity'>
                    @error('engine_capacity')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="lg:flex-1">
                    <label for="number_cylinders" class="text-xs lg:text-md lg:font-medium">
                        Number of Cylinders
                    </label>
                    <input type="number" id="number_cylinders" name="number_cylinders"
                        wire:model.debounce='number_cylinders'>
                    @error('number_cylinders')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            {{-- Specifications --}}
            <div class="h-px w-full shadow"></div>
            <h2 class="text-md lg:text-2xl lg:font-semibold">Specifications</h2>
            <div class="flex flex-col gap-3 md:flex-row lg:items-center lg:gap-6">
                <div class="flex-1">
                    <label for="seating_capacity" class="text-xs lg:text-md lg:font-medium">Seating Capacity</label>
                    <input type="number" id="seating_capacity" name="seating_capacity"
                        wire:model.debounce='seating_capacity'>
                    @error('seating_capacity')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="items-end flex-1">
                    <h4 class="text-xl text-center">Drive Mode</h4>
                    <div class="flex flex-col gap-3 mt-3 lg:items-center lg:flex-row lg:justify-center">
                        <div>
                            <input type="radio" name="drive_mode" value="auto" wire:model.debounce='drive_mode'>
                            <label for="auto">Auto</label>
                        </div>
                        <div>
                            <input type="radio" id="manual" name="drive_mode" value="manual"
                                wire:model.lazy='drive_mode'>
                            <label for="manual">Manual</label>
                        </div>

                        <div>
                            <input type="checkbox" id="four_wheel" name="is_four_wheel" wire:model.lazy='is_four_wheel'>
                            <label for="four_wheel">Four wheel drive?</label>
                        </div>
                        <div>
                            <input type="checkbox" id="is_auto_drive" name="is_is_auto_drive"
                                wire:model.lazy='is_auto_drive'>
                            <label for="is_auto_drive">Self driving?</label>
                        </div>
                    </div>
                    @error('drive_mode')
                        <p class="error text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
            {{-- Third step --}}
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                {{-- Thumbnail --}}
                <div class="col-span-1">
                    @error('car_thumbnail') <p class="error">{{ $message }}</p>@enderror
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col md:flex-row text-sm text-gray-600">
                                <label for="thumb_nail"
                                    class="relative cursor-pointer bg-white rounded-md text-xs lg:text-md lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                    <span>Upload an image</span>
                                    <input id="thumb_nail" name="thumb_nail" type="file" class="sr-only"
                                        wire:model='car_thumbnail'>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB
                            </p>
                        </div>

                    </div>
                    @if ($car_thumbnail)
                        <div class="flex items-center justify-center">
                            <img class="h-56 w-60" src="{{ $car_thumbnail->temporaryUrl() }}">
                        </div>
                    @endif
                </div>
                {{-- Car images --}}
                <div class="col-span-2">
                    @error('car_images') <p class="error">{{ $message }}</p>@enderror
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col md:flex-row text-sm text-gray-600">
                                <label for="car_images"
                                    class="relative cursor-pointer bg-white rounded-md text-xs lg:text-md lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                    <span>Upload images</span>
                                    <input id="car_images" name="car_images" type="file" class="sr-only"
                                        wire:model='car_images' multiple>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 10MB
                            </p>
                        </div>

                    </div>
                    @if ($car_images)
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($car_images as $car_image)
                                <div class="flex items-center justify-center">
                                    <img class="h-56 w-60 shadow-sm" src="{{ $car_image->temporaryUrl() }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>


        @endif
        {{-- controls --}}
        <div class="flex items-center justify-{{ $currentPage == 0 ? 'end' : 'between' }}">
            @if ($currentPage != 0)
                <button type="button" class="btn btn-secondary transition flex items-center gap-2"
                    wire:click='previousPage'>
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Previous</span>
                </button>
            @endif
            @if ($currentPage != count($pages) - 1)
                <button type="button" class="btn btn-secondary transition flex items-center gap-2"
                    wire:click='nextPage'>
                    <span>Next</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            @else
                <button type="submit" class="btn btn-secondary transition">
                    Submit
                </button>
            @endif

        </div>
    </form>
</div>
