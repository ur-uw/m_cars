<div class="relative flex flex-col w-full h-full p-4 overflow-hidden transition rounded shadow-md hover:shadow-xl">
    <h2 class="mb-2 text-lg text-center capitalize lg:text-xl">
        {{ $product->name }} <br>
        <span class="text-sm text-primary">({{ $product->manufacturer->name }})</span>
    </h2>
    {{-- Product type image --}}
    <div class="flex-1">
        <img class="object-contain h-48 min-w-full" src="{{ Storage::url($product->image) }}"
            alt="{{ $product->name }}">
    </div>
    {{-- Product price and action --}}
    <div class="flex flex-col items-center justify-between gap-3 px-3 mt-3">
        <h3 class="text-xl">
            Price: {{ $product->price }} $
        </h3>
        @if ($cart->where('id', $product->id)->count())
            <span class="text-primary"> <i class="fa-solid fa-circle-info"></i> In cart</span>
        @else
            <button wire:click='addToCart({{ $product->id }})' class="transition btn btn-primary">
                Add to Cart
            </button>
        @endif
    </div>
</div>
