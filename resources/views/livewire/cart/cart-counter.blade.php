<a href="{{ route('cart.show') }}"
    class="flex items-center p-3 text-sm {{ Route::is('cart.show') ? 'text-primary' : 'text-gray-600' }} capitalize transition-colors duration-200 transform hover:bg-gray-100 gap-3">
    <i class="fa fa-shopping-cart"></i>
    Cart ({{ $cart_count }})
</a>
