@section('page-title')
    Garage
@endsection

<div class="container">
    <div class="flex items-center justify-center w-full mb-3">
        <div class="ds-tabs">
            <a href="{{ route('garage.show', ['page' => 1]) }}"
                class="ds-tabs-item ds-tab ds-tab-lifted {{ $page == 1 ? 'ds-tab-active' : '' }}"> Owned Cars </a>
            <a href="{{ route('garage.show', ['page' => 2]) }}"
                class="ds-tabs-item ds-tab ds-tab-lifted {{ $page == 2 ? 'ds-tab-active' : '' }}">
                Rented Cars
            </a>
        </div>
    </div>
    <section class="flex flex-col md:flex-row md:items-center">

        {{-- Add car button --}}
        <a href="{{ route('car.create') }}" class="flex items-center justify-between transition btn btn-primary">
            <span>Add Car</span>
            <i class="ml-2 fas fa-plus"></i>
        </a>
    </section>

    {{-- Cars --}}
    @if (count($cars) > 0)
        <div class="grid grid-cols-1 gap-3 mt-6 md:grid-cols-2 lg:grid-cols-4 lg:gap-5">
            @foreach ($cars as $car)
                <livewire:car-card key="{{ $car->id }}" :car="$car">
            @endforeach
        </div>
    @else
        <h3 class="text-lg font-semibold text-center lg:text-2xl text-secondary">
            No Cars!
        </h3>
    @endif
</div>
