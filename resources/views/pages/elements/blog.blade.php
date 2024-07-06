<div class="blog">
    <div class="blog_head">


        @if(isset($blog->blog_image_route) && !empty($blog->blog_image_route))
            <img class="image" src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}">
        @endif

    </div>
    <div class="blog_content">

        <div class="text">
            <h3 class="blog_title">{{ $blog->langField('blog_title') }}</h3>
            <div>
                <span class="date">{{ \Carbon\Carbon::parse($blog->created_at)->isoformat("D MMMM Y")  }}</span>
                <a href="{{ route('blogs', $blog->slug) }}" class="get__full__blog" title="{{ __('Get full blog') }}">{{ __('read') }}</a>
            </div>
        </div>
    </div>
</div>
