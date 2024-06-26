@extends('admin.layout.app')

@section('title', __('Review'))

@section('content')

<div class="container">

    <div class="admin__review__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        <h2>{{ __('Review') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.reviews.index') }}">{{ __('Back') }}</a>

        <div class="review_details">
            <ul class="review_details_list">
                <li><span class="details-name">id:</span><span class="details-content">{{ $review->id }}</span></li>
                <li><span class="details-name">{{ __('Name') }}: </span><span class="details-content">{{ $review->reviewer_name }}</span></li>
                <li><span class="details-name">{{ __('Image') }}: </span><span class="details-content">@if($review->reviewer_image_route)
                    <img class="review__image"
                    src="{{ $review->reviewer_image_route }}" alt="{{ __('Image') }}" />
                @else
                    {{  __('No') }}.
                @endif</span></li>

                @isset($review->backdrop_image)<li><span class="details-name">{{ __('Backdground') }}: <div style="background-color: {{ $review->backdrop_image }};" class="review__img-background"></div></li>@endisset

                <li><span class="details-name">{{ __('Content') }}: </span><span class="details-content">{{ $review->review_content }}</span></li>
                <li><span class="details-name">{{ __('Evaluation') }}: </span><span class="details-content">{{ $review->evaluation }}</span></li>
                <li><span class="details-name">{{ __('Created') }}: </span><span class="details-content">{{ $review->updated_at }}</span></li>
                <li><span class="details-name">{{ __('Edited') }}: </span><span class="details-content">{{ $review->edited }}</span></li>
            </ul>
        </div>

        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" href="{{ route('admin.reviews.edit', $review) }}"><span>{{ __('Edit') }}</span></a>
            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
