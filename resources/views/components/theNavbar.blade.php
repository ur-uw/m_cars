 <nav class="flex items-center p-3 flex-wrap">
     <a href="/"><img src="{{ asset('assets/svg/branding.svg') }}" alt="logo" /></a>
     <div class="inline-flex p-3 rounded lg:hidden ml-auto outline-none transition">
         <i class="
                    fas fa-bars text-2xl text-black" id="menu"></i>
     </div>
     <div class="hidden top-navbar w-full lg:inline-flex lg:flex-grow lg:w-auto transition" id="navigation">
         <ul class="bg-gray-50 lg:bg-white p-5 flex flex-col gap-6 lg:gap-12 lg:flex-row  ml-auto lg:items-center">
             @if (Route::currentRouteName() == 'home')
                 <a href="#" class="hover:text-primary transition">Features</a>
                 <a href="#" class="hover:text-primary transition">Pricing</a>
                 <a href="#">Contact</a>
             @else
                 <a href="{{ route('accessories.show') }}"
                     class="hover:text-primary transition {{ Route::is('accessories.show') || Route::is('accessory.show') ? 'text-primary' : '' }}">Accessories</a>
                 <a href="{{ route('spare_types.show') }} "
                     class="hover:text-primary transition {{ Route::is('spare_types.show') || Route::is('spare_part.show') ? 'text-primary' : '' }}">
                     Spare Parts</a>
                 <a href="{{ route('explore.show') }}"
                     class="hover:text-primary transition {{ Route::is('explore.show') || Route::is('car_details.show') ? 'text-primary' : '' }}">Explore</a>
                 <a href="{{ route('garage.show') }}"
                     class="hover:text-primary transition {{ Route::is('garage.show') ? 'text-primary' : '' }}">Garage</a>


             @endif
             @guest
                 <li>
                     <a href="{{ route('auth.login') }}" class="btn btn-secondary transition flex items-center gap-2">
                         <span>Login</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </a>
                 </li>
             @endguest
             @auth
                 @if (Route::currentRouteName() != 'home')
                     <a href="{{ route('admin-dashboard') }}" class="btn btn-primary transition rounded-md">
                         Admin Dashboard
                     </a>
                     <a href="{{ route('auth.logout') }}" class="btn btn-secondary transition rounded-md">
                         <i class="fas fa-sign-out-alt"></i>
                     </a>
                 @else
                     <a href="{{ route('explore.show') }}" class="btn btn-secondary transition flex items-center gap-2">
                         <span>Explore</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </a>
                 @endif
             @endauth
         </ul>
     </div>
 </nav>
