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
                 <a href="#" class="hover:text-primary transition">Accessories</a>
                 <a href="#" class="hover:text-primary transition">Spare Parts</a>
                 <a href="{{ route('explore.show') }}"
                     class="hover:text-primary transition {{ Route::is('explore.show') ? 'text-primary' : '' }}">Explore</a>
                 <a href="{{ route('garage.show') }}"
                     class="hover:text-primary transition {{ Route::is('garage.show') ? 'text-primary' : '' }}">Garage</a>

             @endif
             @if (!Auth::check())
                 <li>
                     <a href="{{ route('auth.login') }}" class="btn btn-secondary transition flex items-center gap-2">
                         <span>Login</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </a>
                 </li>
             @else
                 @if (Route::currentRouteName() != 'home')
                     <a href="{{ route('auth.logout') }}"
                         class="bg-secondary text-sm md:text-md text-white text-center py-2 block px-6 rounded-md uppercase">
                         Log out
                     </a>
                 @else
                     <a href="{{ route('explore.show') }}"
                         class="btn btn-secondary transition flex items-center gap-2">
                         <span>Explore</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </a>
                 @endif
             @endif
         </ul>
     </div>
 </nav>