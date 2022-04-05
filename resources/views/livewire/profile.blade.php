<section class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    {{-- Profile --}}
    <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                    <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what
                        you
                        share.</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent='updateProfile("profileInfo")'>
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
                            <div>
                                <label class="block text-sm font-medium text-dark-blue"> Photo </label>
                                @if (Auth::user()->image != null)
                                    <div class="flex items-center w-full gap-6">
                                        <img src="{{ $user_image_file != null ? $user_image_file->temporaryUrl() : Storage::url($user_image) }}"
                                            alt="User image" class="bg-cover rounded-full shadow-md"
                                            style="height: 100px;width:100px;">
                                        <label for="user_image_file"
                                            class="relative bg-white rounded-md cursor-pointer btn text-md lg:text-lg lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span class="text-sm">Change</span>
                                            <input wire:model='user_image_file' id="user_image_file"
                                                name="user_image_file" type="file" class="sr-only">
                                        </label>
                                        @error('user_image')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="flex items-center w-full gap-6 mt-1">
                                        @if ($user_image_file != null)
                                            <img src="{{ $user_image_file->temporaryUrl() }}" alt="User image"
                                                class="bg-cover rounded-full shadow-md"
                                                style="height: 100px;width:100px;">
                                        @else
                                            <span
                                                class="inline-block w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                                                <svg class="w-full h-full text-gray-300" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </span>
                                        @endif

                                        <label for="user_image_file"
                                            class="relative bg-white rounded-md cursor-pointer btn text-md lg:text-lg lg:font-medium text-primary hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary">
                                            <span class="text-sm">Change</span>
                                            <input wire:model='user_image_file' id="user_image_file"
                                                name="user_image_file" type="file" class="sr-only"
                                                wire:model='user_image_file'>
                                        </label>
                                        @error('user_image')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                            </div>
                            <div>
                                <label for="about" class="block text-sm font-medium text-dark-blue"> About </label>
                                <div class="mt-1">
                                    <textarea wire:model.lazy='bio' id="about" name="about" rows="3"
                                        class="block w-full mt-1 text-black border border-gray-300 rounded-md shadow-sm sm:text-sm">{{ old('bio') }}</textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Brief description for your profile.</p>
                                @error('bio')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button type="submit" class="transition btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    {{-- Personal Information --}}
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="updateProfile('personalInfo')">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-dark-blue">First
                                        name</label>
                                    <input wire:model.lazy='first_name' type="text" name="first_name" id="first-name"
                                        autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium text-dark-blue">Last
                                        name</label>
                                    <input wire:model.lazy='last_name' type="text" name="last_name" id="last-name"
                                        autocomplete="family-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email-address" class="block text-sm font-medium text-dark-blue">Email
                                        address</label>
                                    <input wire:model.lazy='email' type="text" name="email" id="email-address"
                                        autocomplete="email"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country"
                                        class="block text-sm font-medium text-dark-blue">Country</label>
                                    <select wire:model.lazy='country' id="country" name="country"
                                        autocomplete="country-name"
                                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 sm:text-sm">
                                        <option value="">Select</option>
                                        <option>Iraq</option>
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>Mexico</option>
                                    </select>
                                    @error('country')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="street-address" class="block text-sm font-medium text-dark-blue">Street
                                        address</label>
                                    <input wire:model.lazy='street_address' type="text" name="street_address"
                                        id="street-address" autocomplete="street-address"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('street_address') }}">
                                    @error('street_address')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="city" class="block text-sm font-medium text-dark-blue">City</label>
                                    <input wire:model.lazy='city' type="text" name="city" id="city"
                                        autocomplete="address-level1"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('city') }}">
                                    @error('city')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="region" class="block text-sm font-medium text-dark-blue">State /
                                        Province</label>
                                    <input wire:model.lazy='state' type="text" name="state" id="region"
                                        autocomplete="address-level1"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('state') }}">
                                    @error('state')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="postal-code" class="block text-sm font-medium text-dark-blue">ZIP /
                                        Postal
                                        code</label>
                                    <input wire:model.lazy='postal_code' type="text" name="postal_code" id="postal-code"
                                        autocomplete="postal-code"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                        value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <button type="submit" class="transition btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

</section>
