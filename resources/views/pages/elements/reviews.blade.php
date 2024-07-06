@extends('layouts.index')

@section('title', __('reviews'))

@section('content')

        <section class="all_reviews">

            <div class="all__reviews_top">

                <h2 class="reviews__title">{{ (count($reviews) > 1) ? __('Reviews') : __('Review')}}</h2>

                <a class="all__reviews_btn-return" href="{{ route('index') }}">{{ __('Back') }}</a>
            </div>

            <div class="all__reviews__elements">

                @foreach ($reviews as $review)
                    <div class="review">
                        <div class="review_creator">
                            <span class="name">{{ $review->reviewer_name }}</span>
                            <div class="image" @isset($review->backdrop_image) style="background-color: {{ $review->backdrop_image }};" @endisset>

                                @if(isset($review->reviewer_image_route) && ($review->reviewer_image_route) !== '')

                                <img src="{{  $review->reviewer_image_route }}" alt="{{ $review->reviewer_name }}">

                                @else
                                    {{--  first letter of name  --}}
                                    <h1 class="UC_letters">{{ Str::charAt($review->reviewer_name, 0) }}</h1>
                                    <script></script>
                                @endif
                            </div>
                            <div class="evaluation"><span class="star"></span><span>{{ $review->evaluation }}</span></div>

                        </div>
                        <div class="review_content">
                            <span class="date">{{ \Carbon\Carbon::parse($review->updated_at)->isoformat("D MMMM Y")  }}</span>
                            <p class="content">{{ $review->review_content }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>

@endsection
