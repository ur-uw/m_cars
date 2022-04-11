<footer
    class="p-4 mt-5 bg-primary text-white rounded-lg shadow md:px-6 md:py-8 {{ Route::is('garage.show') || Route::is('admin-dashboard') ? 'absolute left-0 bottom-0 w-full' : '' }}">
    <div class="sm:flex sm:items-center sm:justify-between">
        <a href="/" class="flex items-center mb-4 sm:mb-0">
            <img src="{{ asset('assets/fav_icon/car_logo.svg') }}" class="h-8 mr-3 " alt="MCars Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap ">M CARS</span>
        </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm sm:mb-0 ">
            <li>
                <a href="{{ route('explore.show') }}" class="mr-4 hover:underline md:mr-6 ">Explore</a>
            </li>
            <li>
                <a href="{{ route('map.show') }}" class="mr-4 hover:underline md:mr-6">Map</a>
            </li>
            <li>
                <a href="{{ route('spare_types.show') }}" class="mr-4 hover:underline md:mr-6 ">Spare Parts</a>
            </li>
            <li>
                <a href="{{ route('accessories.show') }}" class="hover:underline">Accessories</a>
            </li>
        </ul>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8">
    <span class="block text-sm sm:text-center ">&copy; 2022 <a href="/" class="hover:underline">M
            Cars</a>. All Rights Reserved.
    </span>
</footer>
