<footer class="items-center p-4 mt-5 ds-footer bg-primary text-neutral-content">
    <div class="items-center grid-flow-col">
        <img src="{{ asset('assets/fav_icon/car_logo.svg') }}" alt="mcars logo">
        <p>M Cars © 2022 - All right reserved</p>
    </div>
    <div class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
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
</footer>
