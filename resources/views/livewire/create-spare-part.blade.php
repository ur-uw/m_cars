<section class="h-full w-full">
    <form wire:submit.prevent='submit' class="container space-y-7 py-5 px-16 lg:px-28 w-3/4">
        <div class="flex items-center gap-3 w-full">
            <div class="flex-1">
                <label for="name" class="text-md lg:text-lg lg:font-medium">Spare Part Name</label>
                <input id="name" wire:model.debounce.350ms='name' name="name" type="text" placeholder="Ex: Air bags">
                @error('name')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="manufacturer" class="text-md lg:text-lg lg:font-medium">Spare Part Manufacturer</label>
                <select wire:model="manufacturer" name="manufacturer" id="manufacturer">
                    <option value="">Select Manufacturer</option>
                    @foreach ($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
                @error('manufacturer')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="flex items-center gap-3 w-full">
            <div class="flex-1">
                <label for="price" class="text-md lg:text-lg lg:font-medium">Spare Part Price</label>
                <input id="price" wire:model.debounce.350ms='price' name="price" type="text">
                @error('price')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="type" class="text-md lg:text-lg lg:font-medium">Spare Part Type</label>
                <select wire:model='spareType' name="spareType" id="spareType">
                    <option value="">Select a Type</option>
                    @foreach ($spareTypes as $spareType)
                        <option value="{{ $spareType->id }}">{{ $spareType->name }}</option>
                    @endforeach
                </select>
                @error('spareType')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">
                Spare image
            </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                        aria-hidden="true">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input wire:model='image' id="file-upload" name="file-upload" type="file"
                                class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        PNG, JPG up to 2MB
                    </p>
                </div>
            </div>
            @error('image')
                <p class="error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary transition w-full text-xl">Save</button>
    </form>

</section>