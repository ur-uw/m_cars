<section class="relative">
    <a class="btn btn-primary text-primary relative -top-4 left-4 lg:fixed lg:top-auto lg:left-1 transition"
        href="{{ route('checkout.show') }}">Checkout</a>
    <div class="container overflow-x-auto">
        <table class="table-auto border min-w-full mb-3">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider"></th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Price
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Quantity
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-sm leading-4 tracking-wider text-center">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <livewire:cart.cart-product-row :product="$product" :cart="$cart" key="{{ $product->id }}" />
                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-orange-500 text-sm leading-5" colspan="3">
                            Your cart is empty
                        </td>
                    </tr>
                @endforelse
                <tr align="center">
                    <td class="py-5">
                        <span class="text-primary">
                            Total Price:
                        </span>
                        {{ \Gloudemans\Shoppingcart\Facades\Cart::priceTotal() * 100 }}$
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
