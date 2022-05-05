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
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="flex flex-col-reverse w-full gap-6 lg:flex-row">
            <div class="flex flex-col flex-1 space-y-6">
                {{-- Billing Details --}}
                <form class="flex-1 space-y-5" method="POST" action="{{ route('checkout.charge_car', ['car' => $car]) }}"
                    id="payment-form">
                    <h2 class="text-lg font-semibold md:text-xl">Billing Details</h2>
                    @csrf
                    <div class="col-span-6 sm:col-span-4">
                        <label for="email-address" class="block text-sm font-medium text-dark-blue">Email
                            address</label>
                        <input required value="{{ old('email') ?? $user->email }}" type="text" name="email"
                            id="email-address" autocomplete="email"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="name" class="block text-sm font-medium text-dark-blue">Name</label>
                        <input required value='{{ old('name') ?? $user->name }}' type="text" name="name" id="name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="address" class="block text-sm font-medium text-dark-blue">Address</label>
                        <input required value='{{ old('address') ?? ($user->address->street ?? '') }}' type="text"
                            name="address" id="address"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                            value="{{ old('address') }}">
                        @error('address')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="city" class="block text-sm font-medium text-dark-blue">City</label>
                            <input required value='{{ old('city') ?? ($user->address->city ?? '') }}' type="text"
                                name="city" id="city"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                value="{{ old('city') }}">
                            @error('city')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-dark-blue">State</label>
                            <input required value='{{ old('state') ?? ($user->address->state ?? '') }}' type="text"
                                name="state" id="address"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                value="{{ old('state') }}">
                            @error('state')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-dark-blue">Postal Code</label>
                            <input required value='{{ old('postal_code') ?? ($user->address->postal_code ?? '') }}'
                                type="text" name="postal_code" id="postal_code"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-dark-blue">Phone</label>
                            <input required type="text" name="phone" id="phone"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- Payment Details --}}
                    <h2 class="text-lg font-semibold md:text-xl">Payment Details</h2>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="name_on_card" class="block text-sm font-medium text-dark-blue">Name on Card
                        </label>
                        <input required value='{{ old('name_on_card') ?? $user->name }}' type="text" name="name_on_card"
                            id="name_on_card"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 sm:text-sm"
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
                    <button class="font-semibold text-center transition btn btn-primary disabled:cursor-not-allowed"
                        type="submit" id="card-button">
                        Create Order
                    </button>
                </form>

            </div>
            {{-- Order Details --}}
            <div class="flex flex-col gap-6 flex-2">
                <h2 class="text-lg font-semibold md:text-xl">
                    Your Order
                </h2>
                <div class="h-px bg-gray-500"></div>
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center flex-1 w-full h-full gap-1">
                        <img style="height: 750x;width:75px;" class="bg-cover"
                            src="{{ strpos($car_image, 'https://') !== false ? $car_image : Storage::url($car_image) }}"
                            alt="{{ $car->model }} image">
                        <div class="flex flex-col gap-2 md:gap-3">
                            <p class="text-base font-medium md:text-lg md:font-semibold text-dark-blue">
                                {{ $car->model }}
                            </p>
                            <p class="text-xs text-gray-700 md:text-sm">
                                {{ Str::limit($car->details->description, 30, $end = '...') }}</p>
                            <p class="text-sm font-medium text-dark-blue">
                                ${{ $car->action == 'FOR_RENT' ? $car->details->price * session('rent_period') : $car->details->price }}
                            </p>
                        </div>
                    </div>
                    <div class="p-2 text-sm font-medium border rounded-sm text-dark-blue">1</div>
                </div>
                <div class="h-px bg-gray-500"></div>
                {{-- Price details --}}
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-dark-blue">Subtotal</p>
                    <p class="text-sm font-medium text-dark-blue">
                        ${{ $car->action == 'FOR_RENT' ? $car->details->price * session('rent_period') : $car->details->price }}
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-dark-blue">Tax</p>
                    <p class="text-sm font-medium text-dark-blue">
                        %0</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-dark-blue">Total</p>
                    <p class="text-sm font-semibold text-dark-blue">
                        ${{ $car->action == 'FOR_RENT' ? $car->details->price * session('rent_period') : $car->details->price }}
                    </p>
                </div>
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
