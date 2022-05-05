<section class="relative">
    @if (count($products) > 0)
        <a class="relative transition btn btn-primary text-primary -top-4 left-4 lg:fixed lg:top-auto lg:left-1"
            href="{{ route('checkout.show') }}">Checkout</a>
    @endif
    <div class="container overflow-x-auto">
        <table class="min-w-full my-5 border table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300"></th>
                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">Name</th>
                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">Price
                    </th>
                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">Quantity
                    </th>
                    <th class="px-6 py-3 text-sm leading-4 tracking-wider text-center border-b-2 border-gray-300">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <livewire:cart.cart-product-row :product="$product" :cart="$cart" key="{{ $product->id }}" />
                @empty
                    <tr>
                        <td colspan="5" class="p-5 text-center">
                            <p class="text-gray-500">No products in cart</p>
                        </td>
                    </tr>
                @endforelse
                @if (count($products) > 1)
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="text-gray-500">Total:
                                {{ \Gloudemans\Shoppingcart\Facades\Cart::priceTotal() * 100 }}$</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
