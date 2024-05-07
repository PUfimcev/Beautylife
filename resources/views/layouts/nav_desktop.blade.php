<ul class="navbar__nav d-flex justify-content-between align-items-center m-auto">
    <li class="nav_item">
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
    </li>
    <li class="nav_item">
        <a href="{{ route('conditions') }}" class="nav_link @routeactive('conditions')">{{__('Payments and delivery')}}</a>
    </li>
    <li class="nav_item">
        <a href="{{ route('blogs') }}" class="nav_link @routeactive('blogs')">{{__('Blogs')}}</a>
    </li>
</ul>
