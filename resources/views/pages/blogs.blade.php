@extends('layouts.index')

@section('title', __('blogs'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('Blogs')}}</span></li>
    </ul>
@endsection

@section('content')

        <section class="blogs">
            <h2 class="blogs__title">{{ __('Blogs') }}</h2>

            <div class="blogs__elements">

                @forelse ($blogs as $blog)
                    @include('pages.elements.blog', ['blog' => $blog])
                @empty
                    <p class="no__blogs">{{ __('There are no blogs') }}</p>
                @endforelse
            </div>

            @if (!isset($blogs) || !empty($blogs))
                <div class="pagination">{{ $blogs->onEachSide(1)->links() }}</div>
            @endif

        </section>

@endsection
