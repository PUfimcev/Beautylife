@extends('admin.layout.app')

@section('title', __('Blogs'))

@section('content')

<div class="container">
    <div class="admin__blogs__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Blogs') }}</h2>

        <a class="btn btn-success message__create" href="{{ route('admin.blogs.create') }}">{{ __('Create') }}</a>

        <table class="table table-striped table__blog">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Blog title') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Summary') }}</th>
                    <th scope="col">{{ __('Created') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($blogs as $blog)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="blog__title">{{ $blog->langField('blog_title') }}</span></td>
                        <td>@if($blog->blog_image_route)
                            <img class="blog__image"
                            src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}" />
                        @else
                            <span>{{  __('No') }}</span>
                        @endif
                        </td>
                        <td><span class="blog__content">{{ $blog->langField('blog_summary') }}</span></td>
                        <td><span class="blog__date">{{ $blog->updated_at->format('H:i / d.m.Y') }}</span></td>

                        <td><form method="POST" action="{{ route('admin.blogs.destroy', $blog->slug) }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-secondary" href="{{ route('admin.blogs.show', $blog->slug) }}"><span>{{ __('Show') }}</span></a>
                                <a class="btn btn-warning" href="{{ route('admin.blogs.edit', $blog->slug) }}"><span>{{ __('Edit') }}</span></a>
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__blogs">
                        <td colspan="8" class="no__blogs_projects">{{ __('There are no blogs') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($blogs) || !empty($blogs))
            <div class="pagination">{{ $blogs->onEachSide(1)->links() }}</div>
        @endif

    </div>
</div>

@endsection
