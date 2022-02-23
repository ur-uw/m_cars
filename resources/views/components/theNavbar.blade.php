 <nav class="flex items-center lg:p-3 flex-wrap relative">
     <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" alt="logo" /></a>
     <div class="inline-flex p-3 rounded lg:hidden ml-auto outline-none transition">
         <i class="fas fa-bars text-2xl text-black" id="menu"></i>
     </div>

     <div class="hidden absolute top-20 right-0 lg:top-0 lg:right-0 z-30 w-full md:w-auto  lg:inline-flex lg:flex-grow animate-fadeIn"
         id="navigation">
         <ul
             class="flex flex-col gap-6 bg-white p-5 rounded shadow-md shadow-gray-600 lg:shadow-none lg:gap-12 lg:flex-row items-start lg:items-center">
             @if (Route::is('home'))
                 <button onclick="scrollToId('features-section')" class="hover:text-primary transition">
                     Features
                 </button>
                 <button class="hover:text-primary transition" onclick="scrollToId('contact-us-section')">
                     Contact Us
                 </button>
             @else
                 <a href="{{ route('accessories.show') }}"
                     class="hover:text-primary transition {{ Route::is('accessories.show') || Route::is('accessory.show') ? 'text-primary' : '' }}">Accessories</a>
                 <a href="{{ route('spare_types.show') }} "
                     class="hover:text-primary transition {{ Route::is('spare_types.show') || Route::is('spare_part.show') ? 'text-primary' : '' }}">
                     Spare Parts</a>
                 <a href="#" class="hover:text-primary transition">Map</a>
             @endif
             <a href="{{ route('explore.show') }}"
                 class="hover:text-primary transition {{ Route::is('explore.show') || Route::is('car_details.show') ? 'text-primary' : '' }}">Explore</a>
             @guest
                 <li>
                     <a href="{{ route('auth.login') }}" class="btn btn-secondary transition flex items-center gap-2">
                         <span>Login</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </a>
                 </li>
             @endguest
             @auth
                 @include('components.theDropDown')
             @endauth
         </ul>
     </div>
 </nav>
