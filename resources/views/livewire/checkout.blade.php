<div class="container">
    <div class="flex flex-col-reverse lg:flex-row gap-6 w-full">
        <div class="flex flex-col flex-1 space-y-6">
            {{-- Billing Details --}}
            <form class="flex-1 space-y-5">
                <h2 class="text-lg md:text-xl font-semibold">Billing Details</h2>
                @csrf
                <div class="col-span-6 sm:col-span-4">
                    <label for="email-address" class="block text-sm font-medium text-dark-blue">Email
                        address</label>
                    <input wire:model.lazy='email' type="text" name="email" id="email-address" autocomplete="email"
                        class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <label for="name" class="block text-sm font-medium text-dark-blue">Name</label>
                    <input wire:model.lazy='name' type="text" name="email" id="name"
                        class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <label for="address" class="block text-sm font-medium text-dark-blue">Address</label>
                    <input wire:model.lazy='billing_address' type="text" name="billing_address" id="address"
                        class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('billing_address') }}">
                    @error('billing_address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="city" class="block text-sm font-medium text-dark-blue">City</label>
                        <input wire:model.lazy='billing_city' type="text" name="billing_city" id="city"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('billing_city') }}">
                        @error('billing_city')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-dark-blue">State</label>
                        <input wire:model.lazy='billing_province' type="text" name="billing_province" id="address"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('billing_province') }}">
                        @error('billing_province')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-dark-blue">Postal Code</label>
                        <input wire:model.lazy='billing_postalcode' type="text" name="billing_postalcode"
                            id="postal_code"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('billing_postalcode') }}">
                        @error('billing_postalcode')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-dark-blue">Phone</label>
                        <input wire:model.lazy='billing_phone' type="text" name="phone" id="phone"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('billing_phone') }}">
                        @error('billing_phone')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
            {{-- Payment Details --}}
            <form class="flex-1 space-y-5">
                <h2 class="text-lg md:text-xl font-semibold">Payment Details</h2>
                @csrf
                <div class="col-span-6 sm:col-span-4">
                    <label for="name_on_card" class="block text-sm font-medium text-dark-blue">Name on Card
                    </label>
                    <input wire:model.lazy='billing_name_on_card' type="text" name="billing_name_on_card"
                        id="name_on_card"
                        class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('billing_name_on_card') }}">
                    @error('billing_name_on_card')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <label for="card" class="block text-sm font-medium text-dark-blue">Credit or debit card</label>
                    <input type="text" name="card" id="card"
                        class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('card')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="btn btn-primary transition text-center font-semibold">Create Order</div>
            </form>
        </div>
        {{-- Order Details --}}
        <div class="flex flex-col gap-6 flex-2">
            <h2 class="text-lg md:text-xl font-semibold">
                Your Order
            </h2>
            @forelse (\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                <div class="h-px bg-gray-500"></div>
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center flex-1 gap-1 w-full h-full">
                        <img style="height: 750x;width:75px;" class="bg-cover"
                            src="{{ Storage::url($item->options->image) }}" alt="{{ $item->name }} image">
                        <div class="flex flex-col gap-2 md:gap-3">
                            <p class="text-md  font-medium md:text-lg md:font-semibold text-dark-blue">
                                {{ $item->name }}
                            </p>
                            <p class="text-xs md:text-sm text-gray-700">{{ $item->options->description }}</p>
                            <p class="text-sm font-medium text-dark-blue">${{ $item->price * 100 }}</p>
                        </div>
                    </div>
                    <div class="text-sm font-medium text-dark-blue border p-2 rounded-sm">{{ $item->qty }}</div>
                </div>
                <div class="h-px bg-gray-500"></div>
            @empty
                <p class="text-sm font-medium text-dark-blue">No items in cart</p>
            @endforelse
            {{-- Price details --}}
            @if (!\Gloudemans\Shoppingcart\Facades\Cart::content()->isEmpty())
                <div class="flex justify-between items-center">
                    <p class="text-sm font-medium text-dark-blue">Subtotal</p>
                    <p class="text-sm font-medium text-dark-blue">
                        ${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() * 100 }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-medium text-dark-blue">Tax</p>
                    <p class="text-sm font-medium text-dark-blue">
                        %{{ \Gloudemans\Shoppingcart\Facades\Cart::tax() * 100 }}</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-sm font-semibold text-dark-blue">Total</p>
                    <p class="text-sm font-semibold text-dark-blue">
                        ${{ \Gloudemans\Shoppingcart\Facades\Cart::total() * 100 }}</p>
                </div>
            @endIf
        </div>
    </div>
</div>
