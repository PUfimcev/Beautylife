

    <div class="headbar__logo-search d-flex flex-row justify-content-around align-items-center">
        <div class="headbar-brand"><a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a></div>
    </div>
    <div class="headbar headbar-mobile d-flex flex-row justify-content-between align-items-center m-auto">

        <div class="headbar__login-cart d-flex flex-row justify-content-around align-items-center">
            @guest
                @if (Route::has('login'))
                    <div><a class="headbar__login login" href="{{ route('login') }}">{{ __('Login') }}</a></div>
                @endif
            @endguest
            @auth
                <div class="headbar__dropdown">
                    <a id="dropdown_toggle" class="dropdown_toggle" href="#">
                        {{ Auth::user()->name }} <span class="dropdown__arrow"></span>
                    </a>

                    @if(Auth::user()->isAdmin())
                        <ul class="dropdown__menu dropdown__menu-auth dropdown__menu-auth-admin"  @if ($current_locale == 'ru') style="left: -80%"@endif>

                            <li><a class="dropdown_item-reff item-reff-auth admin-panel" href="{{ route('admin.index') }}">{{__('Admin panel')}}</a></li>
                            <li><a class="dropdown_item-reff item-reff-auth logout" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}</a></li>
                        </ul>
                    @else
                        <ul class="dropdown__menu dropdown__menu-auth" @if ($current_locale == 'ru') style="left: -90%"@endif>
                            <li><a class="dropdown_item-reff item-reff-auth logout" href="{{ route ('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a></li>
                            <li><a class="dropdown_item-reff item-reff-auth order-history" href="{{ route ('person.order_history') }}">
                            {{ __('Order history') }}
                            </a></li>
                            <li><a class="dropdown_item-reff item-reff-auth basket" href="{{ route ('basket') }}">
                            {{ __('Basket') }}
                            </a></li>
                            <li><a class="dropdown_item-reff item-reff-auth account-setting" href="{{ route ('person.user_account') }}">
                            {{ __('Account setting') }}
                            </a></li>
                        </ul>
                        <div><a href="{{ route ('person.bookmarks') }}"  class="headbar__chosen_prod"></a></div>
                    @endif

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </div>

            @endauth
            <div><a href="{{ route ('basket') }}" class="headbar__cart"><span class="headbar__cart_amount">20</span></a></div>
        </div>
        <div  class="d-flex flex-row justify-content-between align-items-center gap-3">

            <div class="headbar__search d-flex flex-row justify-content-between align-items-center">
                <input class="headbar__search-input" type="text" name="headbar-seach">
                <div class="headbar__search-icon"></div>
            </div>
            <button id="burger-button" class="navbar__toggler" type="button">
                <span class="navbar__toggler-icon"></span>
            </button>
        </div>
    </div>

    <div class="wrap__nav"></div>
    <nav class="nav__line-mobile">
         <a class="nav__cancel-icon mobile"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg></a>

        @includeIf('layouts.nav_mobile')

        <div class="headbar__call mobile">
            <a class="headbar__call_phone" href="tel:+350123230231" role="button">+350 123 230 231</a>
            <a id="headbar__call_request-bnt" class="btn btn-outline-secondary border-1 rounded-0 px-4" href="{{ route('callbacks.create') }}" role="button">{{ __('Request a call') }}</a>
        </div>
        <div class="headbar__dropdown mobile">
            <div id="dropdown_toggle" class="dropdown_toggle mobile">
                {{ __('ENG') }} <span class="dropdown__arrow"></span>
            </div>
            <ul class="dropdown__menu dropdown__menu-lang-mobile">
                @foreach ($available_locales as $locale_name => $locale)
                    @if ($locale === $current_locale)
                        <li><span class="dropdown__item item-lang mobile">{{ __("$locale_name") }}</span></li>
                    @else
                        <li><a class="dropdown_item-reff item-reff-lang mobile" href="{{ route('set_locale', $locale) }}">{{ __("$locale_name") }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>

