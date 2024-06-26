@extends('admin.layout.app')

@section('title', __('Reviews'))

@section('content')

<div class="container">
    <div class="admin__reviews__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Reviews') }}</h2>

        {{-- <a class="btn btn-success message__create" href="{{ route('admin.messages.create') }}">{{ __('Create') }}</a> --}}

        <table class="table table-striped table__review">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Content') }}</th>
                    <th scope="col">{{ __('Evaluation') }}</th>
                    <th scope="col">{{ __('Created') }}</th>
                    <th scope="col">{{ __('Edited') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($reviews as $review)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="review__name">{{ $review->reviewer_name }}</span></td>
                        <td>@if($review->reviewer_image_route)
                            <img class="review__image"
                            src="{{ $review->reviewer_image_route }}" alt="{{ __('Image') }}" />
                        @else
                            <span>{{  __('No') }}</span>
                        @endif
                        </td>
                        <td><span class="review__content">{{ $review->review_content }}</span></td>
                        <td><span class="review__evaluation">{{ $review->evaluation }}</span></td>
                        <td><span class="review__date">{{ $review->updated_at->format('H:i / d.m.Y') }}</span></td>
                        <td><span class="review__edited">{{ __($review->edited) }}</span></td>

                        <td><form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-secondary" href="{{ route('admin.reviews.show', $review) }}"><span>{{ __('Show') }}</span></a>
                                <a class="btn btn-warning" href="{{ route('admin.reviews.edit', $review) }}"><span>{{ __('Edit') }}</span></a>
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__reviews">
                        <td colspan="8" class="no__reviews_projects">{{ __('There are no reviews') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @isset($reviews) <div class="pagination">{{ $reviews->onEachSide(1)->links() }}</div> @endisset

    </div>
</div>

@endsection
