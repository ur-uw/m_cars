<section class="w-full h-full">
    <form wire:submit.prevent='submit' class="container py-5 lg:w-3/4 space-y-7 lg:px-28">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                Check your input
            </div>
        @endif
        <div class="flex flex-col w-full gap-3 lg:flex-row lg:items-center">
            <div class="flex-1">
                <label for="name" class="text-base lg:text-lg lg:font-medium">Spare Part Name</label>
                <input id="name" wire:model.debounce.350ms='name' name="name" type="text" placeholder="Ex: Air bags">
                @error('name')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="manufacturer" class="text-base lg:text-lg lg:font-medium">Spare Part Manufacturer</label>
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
        <div class="flex flex-col w-full gap-3 lg:flex-row lg:items-center">
            <div class="flex-1">
                <label for="price" class="text-base lg:text-lg lg:font-medium">Spare Part Price</label>
                <input id="price" wire:model.debounce.350ms='price' name="price" type="text">
                @error('price')
                    <p class="error">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex-1">
                <label for="type" class="text-base lg:text-lg lg:font-medium">Spare Part Type</label>
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
            <div class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                        aria-hidden="true">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
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

        <button type="submit" class="w-full text-xl transition btn btn-primary">Save</button>
    </form>

</section>
