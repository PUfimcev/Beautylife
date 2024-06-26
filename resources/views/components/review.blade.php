<div class="review">
    <div class="review_head">
        <span class="name">{{ $review->reviewer_name }}</span>
        <div class="evaluation"><span class="star"></span><span>{{ $review->evaluation }}</span></div>

    </div>
    <div class="review_content">
        <div class="image" class="image" @isset($review->backdrop_image) style="background-color: {{ $review->backdrop_image }};" @endisset>

            @if(isset($review->reviewer_image_route) && ($review->reviewer_image_route) !== '')

            <img src="{{ $review->reviewer_image_route }}" alt="{{ $review->reviewer_name }}">

            @else
                {{--  first letter of name  --}}
                <h1 class="UC_letters">{{ Str::charAt($review->reviewer_name, 0) }}</h1>
            @endif
        </div>
        <div class="text">
            <span class="content">{{ $review->review_content }}</span>
            <div>
                <span class="date">{{ \Carbon\Carbon::parse($review->updated_at)->isoformat("D MMMM Y")  }}</span>
                <a href="{{ route('get_all_reviews', $review) }}" class="get__full__review" title="{{ __('Get full review') }}">{{ __('read more') }}</a>
            </div>
        </div>
    </div>
</div>
