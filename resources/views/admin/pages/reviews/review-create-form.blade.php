@extends(isset($review) ? 'admin.layout.app' : 'admin.layout.form-layout')

@section('title', isset($review) ? __('Edit').' '.__('review') :  __('Create').' '.__('review'))

@section('content')

<div class="container">

    <div class="admin__reviews__section-create {{ isset($review) ? "" : "create" }} d-flex flex-column align-items-center justify-content-start">

        @if(!isset($review))

            <div class="review__headbar d-flex justify-content-between align-items-center">
                <a class="headbar-brand__logo" href="{{ route('index') }}">BLife</a>
                <a class="unsubscribe_cancel-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg></a>
            </div>
        @endif

        <h2>{{ isset($review) ? __('Edit') : __('Create') }} {{ __('review') }}</h2>

        @isset($review)
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.reviews.index') }}">{{ __('Back') }}</a>
        @endisset

        <form method="POST"
            @if (isset($review))
                action="{{ route('admin.reviews.update', $review) }}"
            @else
                action="{{ route('admin.reviews.store') }}"
            @endif enctype="multipart/form-data" class="form_review">

            @csrf
            @isset($review)
                @method('PUT')
            @endisset

            <div class="review__create mb-1">
                <label for="reviewer_name" class="col-form-label text-md-end">{{ __('Name') }}:</label>
                <div class="reviewer_name">
                    <input id="reviewer_name" type="text" class="form-control @error('reviewer_name') is-invalid @enderror" name="reviewer_name" value="{{ old('reviewer_name', isset($review) ? $review->reviewer_name  : null) }}"  autocomplete="reviewer_name" autofocus placeholder="{{ __('Name') }}">
                    @error('reviewer_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="review__create mb-1">
                <label for="reviewFile" class="col-form-label">{{ __('User photo') }}:</label>

                @if (isset($review))
                    @if($review->reviewer_image_route !== '' )

                        <p>{{ __('A photo is downloaded') }}</p>
                    @else
                        <p>{{ __('No photo. Select color of backdrop') }}:</p>
                        <input class="form-control" type="color" id="reviewBackdropColor" name="backdrop_image" value="{{ old('backdrop_image', isset($review->backdrop_image) ? $review->backdrop_image : "#000000") }}" >
                    @endif
                @else

                    <input class="form-control" type="file" id="reviewFile" name="reviewFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >

                @endif

            </div>

            <div class="review__create mb-1">
                <label for="evaluation" class="col-form-label text-md-end">{{ __('Evaluation') }} {{ __('from 0 to 5') }}:</label>
                <div class="review_evaluation">
                    <input id="evaluation" type="text" step="0.1" min="0" max="5" class="form-control @error('evaluation') is-invalid @enderror" name="evaluation" value="{{ old('evaluation', isset($review) ? $review->evaluation : null) }}"  autofocus placeholder="{{ __('Evaluation') }}">
                    @error('evaluation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="review__create mb-1">
                <label for="review_content" class="col-form-label text-md-end">{{ __('Review content') }}:</label>

                <div class="review_content-1">
                    <textarea id="review_content" rows="7" class="form-control @error('review_content') is-invalid @enderror" name="review_content"   name="evaluation" value="{{ old('evaluation', isset($review) ? $review->review_content : null) }}" autofocus placeholder="{{ __('Review content') }}">{{ isset($review) ? $review->review_content : null }}</textarea>
                    @error('review_content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__review__form-create" href="">{{ isset($review) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>
    <script>if(document.querySelector('.unsubscribe_cancel-icon')) document.querySelector('.unsubscribe_cancel-icon').addEventListener('click', () => {window.close()});</script>
    <script>window.addEventListener('keydown', (e) => { if(e.key == 'Enter') document.querySelector('.form_review').submit() });</script>
</div>

@endsection


