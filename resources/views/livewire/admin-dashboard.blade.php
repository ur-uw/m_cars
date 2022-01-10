<section class="container">
    <h2 class="text-center text-2xl lg:text-4xl mt-5">
        Control Site Functions
    </h2>
    <h3 class="text-dark-blue text-xs lg:text-sm text-center mb-5">Add cars, spare parts and accessories</h3>
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
        {{-- Add a car --}}
        <a href="#"
            class="flex flex-col  items-center p-10 bg-primary shadow h-48 lg:h-52 rounded hover:shadow-xl transition space-y-6">
            <i class="fas fa-car text-white text-7xl"></i>
            <h3 class="text-white text-xl font-semibold">Add a Car</h3>
        </a>
        {{-- Add a spare part --}}
        <a href="{{ route('spare-part.create') }}"
            class="flex flex-col  items-center p-10 bg-primary shadow h-48 lg:h-52 rounded hover:shadow-xl transition space-y-6">
            <i class="fas fa-tools text-white text-7xl"></i>
            <h3 class="text-white text-xl font-semibold">Add a Spare Part</h3>
        </a>
        {{-- Add an accessory --}}
        <a href="{{ route('accessory.create') }}"
            class="flex flex-col  items-center p-10 bg-primary shadow h-48 lg:h-52 rounded hover:shadow-xl transition space-y-6">
            <i class="fas fa-toolbox text-white text-7xl"></i>
            <h3 class="text-white text-xl font-semibold">Add an Accessory</h3>
        </a>
    </div>
</section>
