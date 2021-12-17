<div class="flex flex-col rounded h-64 w-full shadow-sm p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-lg lg:text-xl mb-2 capitalize">{{ $spare_part_name }}</h2>
    {{-- Spare type image --}}
    <div class="flex-1 h-full w-full">
        <img class="min-h-full min-w-full object-contain" src="{{ Storage::url($spare_part_image) }}"
            alt="{{ $spare_part_name }}">
    </div>
</div>
