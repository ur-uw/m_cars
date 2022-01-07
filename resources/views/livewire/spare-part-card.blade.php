<div class="flex flex-col rounded h-full w-full shadow-md p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-lg lg:text-xl mb-2 capitalize">{{ $spare->name }}</h2>
    {{-- Spare type image --}}
    <div class="flex-1">
        <img class="h-48 min-w-full object-contain" src="{{ Storage::url($spare->image) }}" alt="{{ $spare->name }}">
    </div>
    {{-- Spare price and action --}}
    <div class="flex flex-col items-center justify-between px-3 mt-3 gap-3">
        <h3 class="text-xl text-primary">
            Price: {{ $spare->price }} $
        </h3>
        <button class="btn btn-primary transition">
            Add to Cart
        </button>
    </div>
</div>
