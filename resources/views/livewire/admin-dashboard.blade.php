<section class="container">
    <h2 class="mt-5 text-2xl font-semibold text-center lg:text-5xl">
        Control Site Functions
    </h2>
    <h3 class="mt-1 mb-5 text-xs text-center text-app-grey lg:text-sm">Add/Edit cars, spare parts, accessories and
        service
        places</h3>
    <div class="grid grid-cols-1 gap-3 lg:grid-cols-4">
        {{-- Add a car --}}
        <a href="{{ route('car.create') }}"
            class="flex flex-col items-center h-48 p-10 space-y-6 transition rounded shadow bg-primary lg:h-52 hover:shadow-xl">
            <i class="text-5xl text-white fas fa-car lg:text-7xl"></i>
            <h3 class="text-lg font-semibold text-white lg:text-xl">Add a Car</h3>
        </a>
        {{-- Add a spare part --}}
        <a href="{{ route('spare-part.create') }}"
            class="flex flex-col items-center h-48 p-10 space-y-6 transition rounded shadow bg-primary lg:h-52 hover:shadow-xl">
            <i class="text-5xl text-white fas fa-tools lg:text-7xl"></i>
            <h3 class="text-lg font-semibold text-white lg:text-xl">Add a Spare Part</h3>
        </a>
        {{-- Add an accessory --}}
        <a href="{{ route('accessory.create') }}"
            class="flex flex-col items-center h-48 p-10 space-y-6 transition rounded shadow bg-primary lg:h-52 hover:shadow-xl">
            <i class="text-5xl text-white fas fa-toolbox lg:text-7xl"></i>
            <h3 class="text-lg font-semibold text-white lg:text-xl">Add an Accessory</h3>
        </a>

        {{-- Add a Place --}}
        <a href="{{ route('place.create') }}"
            class="flex flex-col items-center h-48 p-10 space-y-6 transition rounded shadow bg-primary lg:h-52 hover:shadow-xl">
            <i class="text-5xl text-white fas fa-map-location-dot lg:text-7xl"></i>
            <h3 class="text-lg font-semibold text-white lg:text-xl">Add a Place</h3>
        </a>
    </div>
</section>
