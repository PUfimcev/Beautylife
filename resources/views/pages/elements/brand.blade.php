<a class="brand" href="{{ route('brands', Str::slug($brand->brand_name)) }}" title="{{ $brand->brand_name }}">
    <div class="brand_head">


        @if(isset($brand->brand_image_route) && !empty($brand->brand_image_route))
            <img class="image" src="{{ asset('storage/'.$brand->brand_image_route) }}" alt="{{ __('Brand logo') }}">
        @endif

    </div>
    <div class="brand_content">

        <h3 class="brand_title">{{ $brand->brand_name }}</h3>

        <p class="brand_summary">{{ $brand->langField('brand_about') }}</p>

    </div>
</a>
