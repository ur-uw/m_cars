<div class="flex flex-col rounded h-full w-full shadow-md p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-lg lg:text-xl mb-2 capitalize">{{ $product->name }}</h2>
    {{-- Product type image --}}
    <div class="flex-1">
        <img class="h-48 min-w-full object-contain" src="{{ Storage::url($product->image) }}"
            alt="{{ $product->name }}">
    </div>
    {{-- Product price and action --}}
    <div class="flex flex-col items-center justify-between px-3 mt-3 gap-3">
        <h3 class="text-xl">
            Price: {{ $product->price }} $
        </h3>
        @if ($cart->where('id', $product->id)->count())
            <span class="text-primary"> <i class="fa-solid fa-circle-info"></i> In cart</span>
        @else
            <button wire:click='addToCart({{ $product->id }})' class="btn btn-primary transition">
                Add to Cart
            </button>
        @endif
    </div>
</div>
