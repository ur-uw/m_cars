<div class="container">
    <section class="flex flex-col justify-center lg:flex-row lg:items-center lg:justify-between">
        {{-- Search --}}
        <div class="flex items-center py-4 gap-3 lg:w-1/2  ">
            <span class="flex-1">
                <label for="search">Search</label>
                <input id="search" wire:model='term' class="w-full" type="text"
                    placeholder="Ex: Mercedes Benz,...">
            </span>
        </div>
        {{-- Add car button --}}
        <a href="#" class="btn btn-primary flex items-center justify-between transition">
            <span>Add Car</span>
            <i class="fas fa-plus ml-2"></i>
        </a>
    </section>
    {{-- Cars --}}
    @if (count($cars) > 0)
        <div class="mt-6 grid grid-cols-1 gap-3 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                <livewire:car-card key="{{ $car->id }}" :car="$car">
            @endforeach
        </div>
        <div class="my-6">
            {{ $cars->links() }}
        </div>
    @else
        <h3 class="text-lg font-semibold lg:text-2xl text-primary mt-6">No Cars!</h3>
    @endif
</div>
