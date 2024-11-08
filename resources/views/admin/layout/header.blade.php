<div class="container">
    <div class="headbar headbar__admin d-flex justify-content-between align-items-center">

            <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>

            {{-- Navigation in admin panel --}}

            <nav class="navbar__line navbar__line_admin-panel">
                  <ul class="navbar__nav d-flex justify-content-evenly align-items-center">
                        <li class="nav_item">
                            <a href="{{ route('callbacks.index') }}" class="nav_link @routeactive('callbacks*')">{{__('Callbacks')}}</a>
                        </li>
                        {{-- <li class="nav_item">
                            <a href="{{ route('admin.offers.index') }}" class="nav_link @routeactive('admin.offers*')">{{__('Offers')}}</a>
                        </li>
                        <li class="nav_item">
                            <a href="{{ route('admin.brands.index') }}" class="nav_link @routeactive('admin.brands*')">{{__('Brands')}}</a>
                        </li>
                        <li class="nav_item">
                            <a href="{{ route('admin.blogs.index') }}" class="nav_link @routeactive('admin.blogs*')">{{__('Blogs')}}</a>
                        </li>
                        <li class="nav_item">
                            <a href="{{ route('admin.messages.index') }}" class="nav_link @routeactive('admin.messages*')">{{__('Messages')}}</a>
                        </li> --}}
                        <li class="nav_item">
                            <a href="{{ route('admin.reviews.index') }}" class="nav_link @routeactive('admin.reviews*')">{{__('Reviews')}}</a>
                        </li>
                  </ul>
            </nav>

            {{-- dropdown menue of admin panel --}}

            <div class="headbar__dropdown admin">
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

    </div>
    <div class="headbar headbar__admin d-flex justify-content-between align-items-center">

        {{-- Navigation in admin panel --}}

        <nav class="navbar__line navbar__line_admin-panel w-100">
            <ul class="navbar__nav d-flex justify-content-evenly align-items-center w-100">
                <li class="nav_item">
                    <a href="{{ route('admin.brands.index') }}" class="nav_link @routeactive('admin.brands*')">{{__('Brands')}}</a>
                </li>
                <li class="nav_item">
                    <a href="{{ route('admin.offers.index') }}" class="nav_link @routeactive('admin.offers*')">{{__('Offers')}}</a>
                </li>
                <li class="nav_item">
                    <a href="{{ route('admin.messages.index') }}" class="nav_link @routeactive('admin.messages*')">{{__('Messages')}}</a>
                </li>
                <li class="nav_item">
                    <a href="{{ route('admin.blogs.index') }}" class="nav_link @routeactive('admin.blogs*')">{{__('Blogs')}}</a>
                </li>
                {{-- <li class="nav_item">
                    <a href="{{ route('admin.reviews.index') }}" class="nav_link @routeactive('admin.reviews*')">{{__('Reviews')}}</a>
                </li> --}}
            </ul>
        </nav>

    </div>
    <div class="headbar headbar__admin d-flex justify-content-between align-items-center">

        {{-- Navigation in admin panel --}}

        <nav class="navbar__line navbar__line_admin-panel w-100">
              <ul class="navbar__nav d-flex justify-content-evenly align-items-center w-100">
                    <li class="nav_item">
                        <a href="{{ route('admin.categories.index') }}" class="nav_link @routeactive('admin.*categor*')">{{__('Categories')}}</a>
                    </li>
                    <li class="nav_item">
                        <a href="{{ route('admin.skintypes.index') }}" class="nav_link @routeactive('admin.skintype*')">{{__('Skin types')}}</a>
                    </li>
                    <li class="nav_item">
                        <a href="{{ route('admin.ageranges.index') }}" class="nav_link @routeactive('admin.ageranges*')">{{__('Age ranges')}}</a>
                    </li>
                    <li class="nav_item">
                        <a href="{{ route('admin.consumers.index') }}" class="nav_link @routeactive('admin.consumer*')">{{__('Consumers')}}</a>
                    </li>
                    {{-- <li class="nav_item">
                        <a href="{{ route('admin.blogs.index') }}" class="nav_link @routeactive('admin.blogs*')">{{__('Blogs')}}</a>
                    </li>
                    <li class="nav_item">
                        <a href="{{ route('admin.reviews.index') }}" class="nav_link @routeactive('admin.reviews*')">{{__('Reviews')}}</a>
                    </li> --}}
              </ul>
        </nav>

    </div>
</div>
