<div class="flex flex-col rounded h-full w-full shadow-md p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-lg lg:text-xl mb-2 capitalize">{{ $spare_type_name }}</h2>
    {{-- Spare type image --}}
    <div class="flex-1">
        <img class="h-48 min-w-full object-contain" src="{{ Storage::url($spare_type_image) }}"
            alt="{{ $spare_type_name }}">
    </div>
</div>
