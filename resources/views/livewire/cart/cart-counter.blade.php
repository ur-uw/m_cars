<a href="{{ route('cart.show') }}"
    class="flex items-center p-3 text-sm {{ Route::is('cart.show') ? 'text-primary' : 'text-gray-600' }} capitalize transition-colors duration-200 transform hover:bg-gray-100">
    <i class="w-5 h-5 mx-1 text-sm md:text-base fa fa-shopping-cart"></i>
    <span class="mx-1 text-xs md:text-base">
        Cart ({{ $cart_count }})
    </span>
</a>
