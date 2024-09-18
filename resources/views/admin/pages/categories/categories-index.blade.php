@extends('admin.layout.app')

@section('title', __('Categories'))

@section('content')

<div class="container">
    <div class="admin__categories__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Categories') }}</h2>

        @if (isset($archive))
        <a class="btn btn-warning category__create mt-3" href="{{ route('admin.categories.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success category__create" href="{{ route('admin.categories.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning category__create mt-3" href="{{ route('admin.category_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__categories">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Subcategories') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($categories as $category)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="category__code">{{ $category->code }}</span></td>

                        <td><span class="category__name">{{ $category->langField('name') }}</span></td>

                        @if(isset($archive))

                            <td><a class="btn btn-info" href="{{ route('admin.subcategory_archive', $category) }}"><span>{{ __('Open') }}</span></a></td>
                        @else
                            <td><a class="btn btn-info" href="{{ route('admin.subcategories.index', $category) }}"><span>{{ __('Open') }}</span></a></td>
                        @endif

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.category_full_delete', $category) }}"
                            @else
                                action="{{ route('admin.categories.destroy', $category) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.category_show', $category) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.categories.show', $category) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.category_restore', $category) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__categories">
                        <td colspan="8" class="no__categories_projects">{{ __('There are no categories') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($categories) || !empty($categories))
            <div class="pagination">{{ $categories->onEachSide(1)->links() }}</div>
        @endif

    </div>
</div>

@endsection



