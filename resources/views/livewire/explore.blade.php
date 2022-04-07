@section('page-title')
    Explore
@endsection
<div class="container">
    {{-- Search --}}
    <div class="flex items-center gap-3 px-6 py-4 mx-auto rounded-md shadow md:rounded-full lg:w-3/4">
        <i class="text-2xl fas fa-search text-primary"></i>
        <span class="flex-1">
            <input wire:model.debounce.350ms='term' class="w-full border-0 " type="text"
                placeholder="Ex: Mercedes Benz,...">
        </span>
        <span>
            <button class="hidden transition lg:block btn btn-primary">
                Search
            </button>
        </span>
    </div>
    <section class="mt-16 ">

        {{-- Heading and Filters --}}
        <div class="flex flex-col items-start justify-between gap-2 lg:flex-row">
            <div class="mb-3">
                <h1 class="text-xl font-semibold lg:text-2xl">Car Catalogue</h1>
                <p class="text-sm">Explore out cars you might like!</p>
            </div>
            <div class="flex flex-col items-center justify-center w-full gap-3 lg:w-1/2 md:flex-row">
                <div class="flex items-center w-full gap-3 lg:items-start lg:flex-col lg:justify-center lg:gap-0">
                    <label for="manufacturer" class="flex-1">Manufacturer</label>
                    <select id="manufacturer" class="flex-1" wire:model='filterManufacturer'
                        class="text-sm">
                        <option value="">All</option>
                        @foreach ($manufacturers as $man)
                            <option value="{{ $man->id }}">{{ $man->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center w-full gap-3 lg:items-start lg:flex-col lg:justify-center lg:gap-0">
                    <label for="type" class="flex-1">Type</label>
                    <select id="type" class="flex-1" wire:model="filterType" class="text-sm">
                        <option value="">All</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center w-full gap-3 lg:items-start lg:flex-col lg:justify-center lg:gap-0">
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
        <div class="grid grid-cols-1 gap-3 mt-6 md:grid-cols-2 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                {{-- Car card --}}
                <livewire:car-card key="{{ $car->id }}" :car="$car" />
            @endforeach
        </div>
        <div class="my-6">
            {{ $cars->links() }}
        </div>
    @else
        <h3 class="mt-6 text-lg font-semibold lg:text-2xl text-secondary">No Cars!</h3>
    @endif
</div>
