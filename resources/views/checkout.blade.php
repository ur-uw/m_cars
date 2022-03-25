@extends('layouts.app')
@section('styles')
    <style>
        /* Padding for Stripe Element containers */
        .StripeElement {
            border: 1px solid #cccccc;
            padding: 10px 12px;
            border-radius: 4px;
        }

        /* Blue outline on focus */
        .StripeElement--focus {
            border: 2px solid rgb(82 103 223);
        }

    </style>
@endsection
@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="p-5 bg-red-500 text-white text-center my-4 rounded fade transition shadow-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-col-reverse lg:flex-row gap-6 w-full">
            <div class="flex flex-col flex-1 space-y-6">
                {{-- Billing Details --}}
                <form class="flex-1 space-y-5" method="POST" action="{{ route('checkout.charge') }}" id="payment-form">
                    <h2 class="text-lg md:text-xl font-semibold">Billing Details</h2>
                    @csrf
                    <div class="col-span-6 sm:col-span-4">
                        <label for="email-address" class="block text-sm font-medium text-dark-blue">Email
                            address</label>
                        <input required value="{{ $user->email }}" type="text" name="email" id="email-address"
                            autocomplete="email"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="name" class="block text-sm font-medium text-dark-blue">Name</label>
                        <input required value='{{ $user->name }}' type="text" name="name" id="name"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="address" class="block text-sm font-medium text-dark-blue">Address</label>
                        <input required value='{{ $user->address->street }}' type="text" name="address" id="address"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('address') }}">
                        @error('address')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="city" class="block text-sm font-medium text-dark-blue">City</label>
                            <input required value='{{ $user->address->city }}' type="text" name="city" id="city"
                                class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('city') }}">
                            @error('city')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-dark-blue">State</label>
                            <input required value='{{ $user->address->state }}' type="text" name="state" id="address"
                                class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('state') }}">
                            @error('state')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-dark-blue">Postal Code</label>
                            <input required value='{{ $user->address->postal_code }}' type="text" name="postal_code"
                                id="postal_code"
                                class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-dark-blue">Phone</label>
                            <input required type="text" name="phone" id="phone"
                                class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- Payment Details --}}
                    <h2 class="text-lg md:text-xl font-semibold">Payment Details</h2>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="name_on_card" class="block text-sm font-medium text-dark-blue">Name on Card
                        </label>
                        <input required value='{{ $user->name }}' type="text" name="name_on_card" id="name_on_card"
                            class="mt-1  focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('name_on_card') }}">
                        @error('name_on_card')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-3">
                        <label for="card" class="block text-sm font-medium text-dark-blue">Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <button class="btn btn-primary transition text-center font-semibold disabled:cursor-not-allowed"
                        type="submit" id="card-button">
                        Create Order
                    </button>
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
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                fontFamily: 'Poppins, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ env('STRIPE_TEST_PUBLISHABLE_KEY') }}', {
            locale: 'en'
        }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', {
            style: style,
            hidePostalCode: true,
        }); // Create an instance of the card

        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Disable card-button to prevent multiple clicks.
            document.getElementById('card-button').disabled = true;
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    // Enable the card-button to let the user try again.
                    document.getElementById('card-button').disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>
@endsection
