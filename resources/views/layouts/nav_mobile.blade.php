<ul class="nav__nav-mobile">
    <li class="nav_item">
        <a href="{{ route('about') }}" class="nav_link mobile @routeactive('about')">{{ __('About company')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('offers') }}" class="nav_link mobile @routeactive('offers')">{{__('Offers')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('catalog') }}" class="nav_link mobile @routeactive('catalog')">{{__('Catalog')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('brands') }}" class="nav_link mobile @routeactive('brands')">{{__('Brands')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('conditions') }}" class="nav_link mobile @routeactive('conditions')">{{__('Payments and delivery')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('blogs') }}" class="nav_link mobile @routeactive('blogs')">{{__('Blogs')}}</a>
    </li>
</ul>
