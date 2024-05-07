<div class="container">
    <div class="headbar headbar__admin d-flex justify-content-between align-items-center">

            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>

            <!-- Burger menue -->
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            {{-- Navigation in admin panel --}}

            <nav class="navbar__line navbar__line_admin-panel">
                  <ul class="navbar__nav d-flex justify-content-between align-items-center">
                      {{-- <li class="nav_item">
                          <a href="{{ route('about') }}" class="nav_link @routeactive('about')">{{ __('About company')}}</a>
                      </li>
                      <li class="nav_item">
                          <a href="{{ route('offers') }}" class="nav_link @routeactive('offers')">{{__('Offers')}}</a>
                      </li>
                      <li class="nav_item">
                          <a href="{{ route('catalog') }}" class="nav_link @routeactive('catalog')">{{__('Catalog')}}</a>
                      </li>
                      <li class="nav_item">
                          <a href="{{ route('brands') }}" class="nav_link @routeactive('brands')">{{__('Brands')}}</a>
                      </li> --}}
                      <li class="nav_item">
                          <a href="{{ route('callbacks.index') }}" class="nav_link @routeactive('callbacks.index')">{{__('Callbacks')}}</a>
                      </li>
                      {{-- <li class="nav_item">
                          <a href="{{ route('blogs') }}" class="nav_link @routeactive('blogs')">{{__('Blogs')}}</a>
                      </li> --}}
                  </ul>
            </nav>

            {{-- dropdown menue of admin panel --}}

            <div class="headbar__dropdown">
                <a id="dropdown_toggle" class="dropdown_toggle" href="#">
                    {{ Auth::user()->name }} <span class="dropdown__arrow"></span>
                </a>
                @if(Auth::user()->isAdmin())
                <ul class="dropdown__menu dropdown__menu-auth dropdown__menu-auth-admin-panel">

                    <li><a class="dropdown_item-reff item-reff-auth admin-panel" href="{{ route('index') }}">{{__('Home')}}</a></li>
                    <li><a class="dropdown_item-reff item-reff-auth logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </ul>
                @endif
                <button class="navbar__toggler" type="button">
                    <span class="navbar__toggler-icon"></span>
                </button>
            </div>


            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->




                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>--}}
        {{-- </div> --}}
    </div>
</div>