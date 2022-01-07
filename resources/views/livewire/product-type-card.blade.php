<div class="flex flex-col rounded h-full w-full shadow-md p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-lg lg:text-xl mb-2 capitalize">{{ $product_type_name }}</h2>
    {{-- Product type image --}}
    <div class="flex-1">
        <img class="h-48 min-w-full object-contain" src="{{ Storage::url($product_type_image) }}"
            alt="{{ $product_type_name }}">
    </div>
</div>
