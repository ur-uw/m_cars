<div class="ds-dropdown ds-dropdown-end">
    <label tabindex="0" class="m-2 text-xs md:text-lg btn btn-primary">{{ $name }}</label>
    <ul tabindex="0" class="w-56 p-2 shadow ds-dropdown-content ds-menu bg-base-100 rounded-box">
        <li>
            <span
                class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-200 transform hover:bg-gray-100 ">
                <img class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9"
                    src="{{ $image != null ? Storage::url($image) : 'https://p.kindpng.com/picc/s/78-785827_user-profile-avatar-login-account-male-user-icon.png' }}"
                    alt="Profile Avatar">
                <div class="mx-1">
                    <h1 class="text-xs text-gray-700 lg:font-semibold lg:text-base">{{ $name }}</h1>
                    <p class="text-xs text-gray-500 lg:text-sm">{{ $email }}</p>
                </div>
            </span>
        </li>

        <hr class="border-gray-200">

        <li>
            <a href="{{ route('profile.show') }}"
                class="flex items-center p-3 text-sm {{ Route::is('profile.show') ? 'text-primary' : 'text-gray-600' }}  capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                <svg class="w-5 h-5 mx-1 text-sm md:text-base" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8C17 10.7614 14.7614 13 12 13C9.23858 13 7 10.7614 7 8ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z"
                        fill="currentColor"></path>
                    <path
                        d="M6.34315 16.3431C4.84285 17.8434 4 19.8783 4 22H6C6 20.4087 6.63214 18.8826 7.75736 17.7574C8.88258 16.6321 10.4087 16 12 16C13.5913 16 15.1174 16.6321 16.2426 17.7574C17.3679 18.8826 18 20.4087 18 22H20C20 19.8783 19.1571 17.8434 17.6569 16.3431C16.1566 14.8429 14.1217 14 12 14C9.87827 14 7.84344 14.8429 6.34315 16.3431Z"
                        fill="currentColor"></path>
                </svg>

                <span class="mx-1 text-xs md:text-base">
                    view profile
                </span>
            </a>
        </li>

        <hr class="border-gray-200">
        <li>
            <livewire:cart.cart-counter>

        </li>
        {{-- GARAGE --}}

        <li>
            <a href="{{ route('garage.show', ['page' => 1]) }}"
                class="flex items-center p-3 text-sm {{ Route::is('garage.show') ? 'text-primary' : 'text-gray-600' }} capitalize transition-colors duration-200 transform hover:bg-gray-100">
                <i class="w-5 h-5 mx-1 text-sm md:text-base fa fa-warehouse"></i>
                <span class="mx-1 text-xs md:text-base">
                    Garage
                </span>
            </a>
        </li>
        @admin
        {{-- ADMIN DASHBOARD --}}
        <li>
            <a href="{{ route('admin-dashboard') }}"
                class="flex items-center p-3 text-sm {{ Route::is('admin-dashboard') ? 'text-primary' : 'text-gray-600' }} capitalize transition-colors duration-200 transform hover:bg-gray-100">
                {{-- Admin Icon --}}
                <i class="w-5 h-5 mx-1 text-sm md:text-base fa fa-user-shield"></i>
                <span class="mx-1 text-xs md:text-base">
                    Admin Dashboard
                </span>
            </a>
        </li>
        @endadmin
        <hr class="border-gray-200">
        <li>
            <a href="{{ route('auth.logout') }}"
                class="flex items-center p-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform hover:bg-gray-100 ">
                <svg class="w-5 h-5 mx-1 text-sm md:text-base" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19 21H10C8.89543 21 8 20.1046 8 19V15H10V19H19V5H10V9H8V5C8 3.89543 8.89543 3 10 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21ZM12 16V13H3V11H12V8L17 12L12 16Z"
                        fill="currentColor"></path>
                </svg>

                <span class="mx-1 text-xs md:text-base">
                    Sign Out
                </span>
            </a>
        </li>
    </ul>
</div>
