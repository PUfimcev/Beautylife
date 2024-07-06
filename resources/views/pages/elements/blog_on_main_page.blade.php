<div class="blog__elem_on_main-page blog_{{ $i }}">
    <div class="blog__elem_on_main-page_top">


        @if(isset($blog->blog_image_route) && !empty($blog->blog_image_route))
            <img class="image" src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}">
        @endif

    </div>
    <div class="blog__elem_on_main-page__content">

        <div class="text">
            <p class="blog_title">{{ $blog->langField('blog_title') }}</p>
            <div>
                <span class="date">{{ \Carbon\Carbon::parse($blog->created_at)->isoformat("D MMMM Y")  }}</span>
                <a href="{{ route('blogs', $blog->slug) }}" class="get__full__blog" title="{{ __('Get full blog') }}">{{ __('read') }}<span class="get__full__blog-btn-arrow"></span></a>
            </div>
        </div>
    </div>
</div>
