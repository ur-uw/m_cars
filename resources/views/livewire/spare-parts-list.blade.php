@section('page-title')
    {{ Str::upper($spare_type->name) }}
@endsection
<div class="container">
    {{-- Search section --}}
    <section class="mb-6">
        <div class="mx-auto lg:w-3/4 flex items-center shadow px-6 py-4 gap-3 rounded-full">
            <i class="fas fa-search text-2xl text-primary"></i>
            <span class="flex-1">
                <input wire:model.debounce.350ms='term' class=" border-0 w-full" type="text"
                    placeholder="Ex: Brake disks,...">
            </span>
            <span>
                <button class="hidden lg:block btn btn-primary transition">
                    Search
                </button>
            </span>
        </div>
    </section>
    {{-- Heading and Filters --}}
    <section class="my-10">
        <div class="flex flex-col lg:flex-row items-start justify-between gap-2">
            <div class="mb-3">
                <h1 class="text-xl lg:text-2xl font-semibold">Spare Part Catalogue</h1>
                <p class="text-sm">Explore out spare parts for your car</p>
            </div>
            <div class="flex justify-center items-center w-full flex-col lg:w-1/2 md:flex-row  gap-3">
                <div class="flex items-center w-full lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="manufacturer" class="flex-1">Manufacturer</label>
                    <select wire:click='loadManufacturers' id="manufacturer" class="flex-1"
                        wire:model='filterManufacturer' class="text-sm">
                        <option value="">All</option>
                        @if ($manufacturers)
                            @foreach ($manufacturers as $man)
                                <option value="{{ $man->id }}">{{ $man->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- Spare Parts Section --}}
    <section>
        <h1 class="text-center text-lg lg:font-semibold lg:text-4xl capitalize mb-2">
            {{ $spare_type->name }}
        </h1>
        @if (count($spare_parts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
                @foreach ($spare_parts as $spare_part)
                    <livewire:product-card :product="$spare_part" key="{{ $spare_part->id }}" />
                @endforeach
            </div>
        @else
            <h2 class="text-center text-secondary text-2xl mt-10">
                No Spare Parts!
            </h2>
        @endif
    </section>

</div>
