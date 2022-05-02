@section('page-title')
    Create Car
@endsection
<div class="container">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="flex items-center justify-center gap-3 mb-3">
        {{-- Step indicators --}}
        @for ($i = 0; $i < count($pages); $i++)
            <button type='button'
                class="rounded-full cursor-pointer bg-{{ $currentPage == $i ? 'primary' : 'app-grey' }}  h-2 w-2"
                wire:click='setPage({{ $i }})'>
            </button>
        @endfor
    </div>
    <h1 class="text-lg font-semibold text-center lg:font-bold lg:text-4xl">{{ $pages[$currentPage]['heading'] }}</h1>
    <form wire:submit.prevent='submit' class="container py-5 space-y-7 lg:px-28">
        @if ($currentPage == 0)
            {{-- First step --}}
            <div class="flex flex-col gap-3 md:items-center md:flex-row">
                <div class="flex-1">
                    <label for="model" class="text-base lg:text-lg lg:font-medium">Model Name</label>
                    <input id="model" wire:model.debounce.350ms='model' name="model" type="text" placeholder="Ex: X6">
                    <p class="mt-1 text-xs text-app-grey">Do not exceed 20 characters when entering model name!
                    </p>
                    @error('model')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="color" class="text-base lg:text-lg lg:font-medium">Car Color</label>
                    <input id="color" type="text" name="color" wire:model.debounce.350ms='color'
                        placeholder="Ex: #ffffff">
                    <p class="mt-1 text-xs text-app-grey">Enter color name in hex format!</p>
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
                        <label for="manufacturer" class="text-base lg:text-lg lg:font-medium">Manufacturer</label>
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
                        <label for="type" class="text-base lg:text-lg lg:font-medium">Car Type</label>
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
                        <label for="plate_number" class="text-base lg:text-lg lg:font-medium">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number"
                            wire:model.debounce.350ms='plate_number' placeholder="Ex: 33-2S1-BNX" />
                        @error('plate_number')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Manufacturer and Date --}}
            <div class="flex flex-col w-full gap-3 md:items-center md:flex-row ">
                <div class="flex-1">
                    <label for="manufactured_at" class="text-base lg:text-lg lg:font-medium">Manufacture Date</label>
                    {{-- TODO: make custom date picker --}}
                    <input type="date" name="manufactured_at" id="manufactured_at" wire:model.lazy='manufactured_at'>
                    @error('manufactured_at')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="price" class="text-base lg:text-lg lg:font-medium">Price <sub
                            class="text-xs text-primary">$</sub>
                    </label>
                    <input type="number" name="price" id="price" wire:model.debounce.350ms="price">
                    @error('price')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            {{-- Description --}}
            <div class="flex flex-col items-center gap-3 md:flex-row md:items-start">

                <div class="flex-1 w-full">
                    <label for="description" class="text-base lg:text-lg lg:font-medium">Description</label>
                    <textarea name="description" id="description" cols="20" rows="5" wire:model.debounce.350ms='description'></textarea>
                    <p class="mt-1 text-xs text-app-grey">Do not exceed 100 characters when entering car description!
                    </p>
                    @error('description')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col items-center w-full md:w-auto">
                    <label for="action" class="text-base lg:text-lg lg:font-medium">Action</label>
                    <select wire:model='action' name="action" id="action">
                        <option value="">Just Show in Garage</option>
                        <option value="FOR_SALE">For Sale</option>
                        <option value="FOR_RENT">For Rent</option>
                    </select>
                    @admin
                    <div class="flex items-center flex-1 w-full gap-2 p-5 mt-4 transition border rounded shadow cursor-pointer md:w-auto border-primary hover:shadow-xl"
                        wire:click='$toggle("formMyGarage")'>
                        <input type="checkbox" wire:model='formMyGarage' name="for_my_garage" id="for_my_garage">
                        <label for="action" class="text-base">Add to my garage</label>
                    </div>
                    @endadmin
                </div>

            </div>
            {{-- Second step --}}
        @elseif ($currentPage == 1)
            {{-- Fuel Details --}}
            <h2 class="text-base lg:text-2xl lg:font-semibold">Fuel Details</h2>
            <div>
                <div class="flex flex-col gap-3 md:flex-row lg:items-center">
                    <div>
                        <label for="fuel_type" class="text-base lg:text-lg lg:font-medium">Fuel Type</label>
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
                            <label for="battery_capacity" class="text-base lg:text-lg lg:font-medium">Battery
                                Capacity</label>
                            <input type="number" id="battery_capacity" name="battery_capacity"
                                wire:model.debounce.350ms='battery_capacity'>
                            @error('battery_capacity')
                                <p class="error">
                                    {{ $message }}
                                </p>
                            @enderror
                        @else
                            <label for="tank_capacity" class="text-base lg:text-lg lg:font-medium">Tank Capacity
                                <sub class="text-xs text-primary">L</sub>
                            </label>
                            <input type="number" id="tank_capacity" name="tank_capacity"
                                wire:model.debounce.350ms='tank_capacity'>
                            @error('tank_capacity')
                                <p class="error">
                                    {{ $message }}
                                </p>
                            @enderror
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="fuel_economy" class="text-base lg:text-lg lg:font-medium">
                            Fuel Economy
                            <sub class="text-xs text-primary">
                                @if ($fuel_type == 'electricity')
                                    A/Km
                                @else
                                    L/Km
                                @endif
                            </sub>
                        </label>
                        <input type="number" id="fuel_economy" name="fuel_economy"
                            wire:model.debounce.350ms='fuel_economy'
                            placeholder="{{ $fuel_type == 'electricity' ? 'Ex: 1 = Ampere per Kilometer' : '1 = Litter per Kilometer' }}">
                        @error('fuel_economy')
                            <p class="error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>
            {{-- Speed & Engine Details --}}
            <div class="w-full h-px shadow"></div>
            <h2 class="text-base lg:text-2xl lg:font-semibold">Speed & Engine Details</h2>
            <div class="flex flex-col gap-3 md:flex-row lg:items-center">
                <div>
                    <label for="top_speed" class="text-base lg:text-lg lg:font-medium">
                        Top Speed
                        <sub class="text-xs text-primary">Km/H</sub>
                    </label>
                    <input type="number" id="top_speed" name="top_speed" wire:model.debounce.350ms='top_speed'>
                    @error('top_speed')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="acceleration" class="text-base lg:text-lg lg:font-medium">
                        Acceleration
                    </label>
                    <input type="number" id="acceleration" name="acceleration" wire:model.debounce.350ms='acceleration'>
                    @error('acceleration')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="gearbox_speeds" class="text-base lg:text-lg lg:font-medium">
                        Gearbox Speeds
                    </label>
                    <input type="number" id="gearbox_speeds" name="gearbox_speeds"
                        wire:model.debounce.350ms='gearbox_speeds'>
                    @error('gearbox_speeds')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            {{-- Engine Details --}}
            <div class="flex flex-col gap-3 md:flex-row lg:items-center">
                <div class="lg:flex-1">
                    <label for="engine_capacity" class="text-base lg:text-lg lg:font-medium">
                        Engine Capacity
                        <sub class="text-xs text-primary">CC</sub>
                    </label>
                    <input type="number" id="engine_capacity" name="engine_capacity"
                        wire:model.debounce.350ms='engine_capacity'>
                    @error('engine_capacity')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="lg:flex-1">
                    <label for="number_cylinders" class="text-base lg:text-lg lg:font-medium">
                        Number of Cylinders
                    </label>
                    <input type="number" id="number_cylinders" name="number_cylinders"
                        wire:model.debounce.350ms='number_cylinders'>
                    @error('number_cylinders')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            {{-- Specifications --}}
            <div class="w-full h-px shadow"></div>
            <h2 class="text-base lg:text-2xl lg:font-semibold">Specifications</h2>
            <div class="flex flex-col gap-3 md:flex-row lg:items-center lg:gap-6">
                <div class="flex-1">
                    <label for="seating_capacity" class="text-base lg:text-lg lg:font-medium">Seating Capacity</label>
                    <input type="number" id="seating_capacity" name="seating_capacity"
                        wire:model.debounce.350ms='seating_capacity'>
                    @error('seating_capacity')
                        <p class="error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-center gap-3">
                        <div class="flex items-center gap-2 lg:flex-row">
                            <label for="auto" class="text-sm">Auto</label>
                            <input type="radio" name="drive_mode" value="auto" wire:model.debounce.350ms='drive_mode'>
                            <label for="manual" class="text-sm">Manual</label>
                            <input type="radio" id="manual" name="drive_mode" value="manual"
                                wire:model.lazy='drive_mode'>
                        </div>
                        |
                        <div class="flex items-center gap-2">
                            <label for="four_wheel" class="text-sm">Four wheel drive?</label>
                            <input type="checkbox" id="four_wheel" name="is_four_wheel" wire:model.lazy='is_four_wheel'>
                            |
                            <label for="is_auto_drive" class="text-xs">Self driving?</label>
                            <input type="checkbox" id="is_auto_drive" name="is_is_auto_drive"
                                wire:model.lazy='is_auto_drive'>
                        </div>
                    </div>
                    @error('drive_mode')
                        <p class="text-center error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
            {{-- Third step --}}
        @else
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                {{-- Thumbnail --}}
                <div class="md:col-span-1 {{ $car_thumbnail != null ? 'grid grid-rows-2 gap-3' : '' }}">
                    @error('car_thumbnail')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div
                        class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col items-center text-sm text-gray-600 md:flex-row">
                                <label for="thumb_nail"
                                    class="relative bg-white rounded-md cursor-pointer text-base lg:text-lg lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                    <span class="text-sm">Upload image preview</span>
                                    <input id="thumb_nail" name="thumb_nail" type="file" class="sr-only"
                                        wire:model='car_thumbnail'>
                                </label>
                                <p class="pl-1 text-xs">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB
                            </p>
                        </div>

                    </div>
                    @if ($car_thumbnail)
                        <div
                            class="flex items-center justify-center w-full h-full transition shadow-sm hover:shadow-md">
                            <img class="object-contain max-w-full max-h-full"
                                src="{{ $car_thumbnail->temporaryUrl() }}">
                        </div>
                    @endif
                </div>
                {{-- Car images --}}
                <div class="md:col-span-2">
                    @error('car_images')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div
                        class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col items-center text-sm text-gray-600 md:flex-row">
                                <label for="car_images"
                                    class="relative bg-white rounded-md cursor-pointer text-base lg:text-lg lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                    <span class="text-sm">Upload images</span>
                                    <input id="car_images" name="car_images" type="file" class="sr-only"
                                        wire:model='car_images' multiple>
                                </label>
                                <p class="pl-1 text-xs">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 10MB
                            </p>
                        </div>

                    </div>
                    @if ($car_images)
                        <div class="grid grid-cols-3 gap-3 mt-3">
                            @foreach ($car_images as $car_image)
                                <div
                                    class="flex items-center justify-center w-full h-full transition shadow-sm hover:shadow-md">
                                    <img class="object-contain max-w-full max-h-full"
                                        src="{{ $car_image->temporaryUrl() }}">
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
                <button type="button" class="flex items-center gap-2 transition btn btn-secondary"
                    wire:click='previousPage'>
                    <i class="text-sm fas fa-arrow-left"></i>
                    <span>Previous</span>
                </button>
            @endif
            @if ($currentPage != count($pages) - 1)
                <button type="button" class="flex items-center gap-2 transition btn btn-secondary"
                    wire:click='nextPage'>
                    <span>Next</span>
                    <i class="text-sm fas fa-arrow-right"></i>
                </button>
            @else
                <button type="submit" class="transition btn btn-secondary">
                    Submit
                </button>
            @endif

        </div>
    </form>
</div>
