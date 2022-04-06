<section class="w-full h-full">
    <form wire:submit.prevent='submit' class="container w-full mt-5 lg:w-3/4 space-y-7 lg:px-28">
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
        {{-- Name and Phone --}}
        <div class="flex flex-col w-full gap-3 lg:flex-row lg:items-center">
            <div class="flex-1">
                <label for="name" class="text-md lg:text-lg lg:font-medium">Place Name</label>
                <input id="name" wire:model.debounce.350ms='name' name="name" type="text">
                @error('name')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="phone" class="text-md lg:text-lg lg:font-medium">Phone Number</label>
                <input id="phone" wire:model.debounce.350ms='phone' name="phone" type="text">
                @error('phone')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        {{-- Place coordinates --}}
        <div class="flex flex-col w-full gap-3 lg:flex-row lg:items-center">
            <div class="flex-1">
                <label for="latitude" class="text-md lg:text-lg lg:font-medium">Latitude</label>
                <input id="latitude" wire:model.debounce.350ms='latitude' name="latitude" type="text">
                @error('latitude')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="longitude" class="text-md lg:text-lg lg:font-medium">Longitude</label>
                <input id="longitude" wire:model.debounce.350ms='longitude' name="longitude" type="text">
                @error('longitude')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        {{-- Place description --}}
        <div class="flex flex-col-reverse w-full gap-5 lg:flex-row lg:items-start">
            <div class="flex-1">
                <label for="description" class="text-md lg:text-lg lg:font-medium">Description</label>
                <textarea wire:model.debounce.350ms='description' name="description" id="description" cols="30" rows="5"
                    maxlength="255"></textarea>
                @error('description')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col justify-center gap-1 flex-2">
                <label for="type" class="text-md lg:text-lg lg:font-medium">Place Type</label>
                <select name="type" id="type" wire:model='type'>
                    <option selected value="">Select</option>
                    @forelse ($placeTypes as $placeType)
                        <option value="{{ $placeType->id }}">{{ $placeType->name }}</option>
                    @empty
                        {{-- Show Places --}}
                        <div class="text-lg text-app-grey">
                            No Places
                        </div>
                    @endforelse
                </select>
                @error('type')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <button type="submit" class="w-full text-xl transition btn btn-primary">Save</button>
    </form>

</section>
