<a href="#"
    class="flex flex-col rounded h-full w-full shadow-sm p-4 overflow-hidden transition hover:shadow-xl relative">
    <h2 class="text-center text-xl mb-2">{{ $spare_type_name }}</h2>
    {{-- Spare type image --}}
    <div class="flex-1 h-full w-full">
        <img class="max-h-full max-w-full object-contain" src="{{ $spare_type_image }}" alt="{{ $spare_type_name }}">
    </div>
</a>
