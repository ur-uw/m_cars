<ul class="ds-menu ds-menu-horizontal">
    <!-- Navbar menu content here -->
    <li> <a href="{{ route('home') }}" class=" transition {{ Route::is('home') ? 'text-primary' : '' }}">Home</a>
    </li>
    @if (Route::is('home'))
        <li>
            <button onclick="scrollToId('features-section')" class="transition ">
                Features
            </button>
        </li>
        <li>
            <button class="transition " onclick="scrollToId('contact-us-section')">
                Contact Us
            </button>
        </li>
    @else
        <li>
            <a href="{{ route('accessories.show') }}"
                class=" transition {{ Route::is('accessories.show') || Route::is('accessory.show') ? 'text-primary' : '' }}">Accessories</a>
        </li>
        <li>
            <a href="{{ route('spare_types.show') }} "
                class=" transition {{ Route::is('spare_types.show') || Route::is('spare_part.show') ? 'text-primary' : '' }}">
                Spare Parts</a>
        </li>
    @endif
    <li>
        <a href="{{ route('map.show') }}"
            class="{{ Route::is('map.show') ? 'text-primary' : '' }}  transition">Map</a>
    </li>
    <li>
        <a href="{{ route('explore.show') }}"
            class=" transition {{ Route::is('explore.show') || Route::is('car_details.show') ? 'text-primary' : '' }}">Explore</a>
    </li>

    @guest
        <li>
            <a href="{{ route('auth.login') }}" class="flex items-center gap-2 ml-2 transition btn btn-secondary">
                <span>Login</span>
                <i class="text-sm fas fa-arrow-right"></i>
            </a>
        </li>
    @endguest
</ul>
