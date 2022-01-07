@section('page-title')
    Explore
@endsection
<div class="container">
    {{-- Search --}}
    <section class="container">
        <div class="mx-auto lg:w-3/4 flex items-center shadow px-6 py-4 gap-3 rounded-full">
            <i class="fas fa-search text-2xl text-primary"></i>
            <span class="flex-1">
                <input wire:model.debounce.350ms='term' class=" border-0 w-full" type="text"
                    placeholder="Ex: Mercedes Benz,...">
            </span>
            <span>
                <button class="hidden lg:block btn btn-primary transition">
                    Search
                </button>
            </span>
        </div>
    </section>
    <section class=" mt-16">

        {{-- Heading and Filters --}}
        <div class="flex flex-col lg:flex-row items-start justify-between gap-2">
            <div class="mb-3">
                <h1 class="text-xl lg:text-2xl font-semibold">Car Catalogue</h1>
                <p class="text-sm">Explore out cars you might like!</p>
            </div>
            <div class="flex justify-center items-center w-full flex-col lg:w-1/2 md:flex-row  gap-3">
                <div class="flex items-center w-full lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="manufacturer" class="flex-1">Manufacturer</label>
                    <select id="manufacturer" class="flex-1" wire:model='filterManufacturer'
                        class="text-sm">
                        <option value="">All</option>
                        @foreach ($manufacturers as $man)
                            <option value="{{ $man->id }}">{{ $man->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full items-center lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="type" class="flex-1">Type</label>
                    <select id="type" class="flex-1" wire:model="filterType" class="text-sm">
                        <option value="">All</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full items-center lg:items-start lg:flex-col lg:justify-center gap-3 lg:gap-0">
                    <label for="rating" class="flex-1">Rating</label>
                    <select id="rating" class="flex-1" class="text-sm">
                        <option value="">All</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </section>
    {{-- Cars --}}
    @if (count($cars) > 0)
        <div class="mt-6 grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                {{-- Car card --}}
                <livewire:car-card key="{{ $car->id }}" :car="$car" />
            @endforeach
        </div>
        <div class="my-6">
            {{ $cars->links() }}
        </div>
    @else
        <h3 class="text-lg font-semibold lg:text-2xl text-secondary mt-6">No Cars!</h3>
    @endif
</div>
