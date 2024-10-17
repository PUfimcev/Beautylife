@extends('admin.layout.app')

@section('title', __('Subcategories'))

@section('content')

<div class="container">
    <div class="admin__subcategories__section d-flex flex-column align-items-center justify-content-start">

        @if (!isset($archive))
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.categories.index') }}">{{ __('Category') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.category_archive') }}">{{ __('Category') }}</a>

        @endif


        <h2>{{ __('Category') }}: {{ $category->langField('name') }}</h2>
        <h3>{{  Str::lower(__('Subcategories')) }}</h3>

        @if (isset($archive))
             @if (!$category->trashed())
                <a class="btn btn-warning subcategory__create mt-3" href="{{ route('admin.subcategories.index', $category) }}">{{ __('Active') }}</a>
            @endif

        @else
            <a class="btn btn-success subcategory__create" href="{{ route('admin.subcategories.create', $category) }}">{{ __('Create') }}</a>

            <a class="btn btn-warning subcategory__create mt-3" href="{{ route('admin.subcategory_archive', $category) }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__subcategories">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($subcategories as $subcategory)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="subcategory__code">{{ $subcategory->code }}</span></td>

                        <td><span class="subcategory__name">{{ $subcategory->langField('name') }}</span></td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.subcategory_full_delete', [$category, $subcategory]) }}"
                            @else
                                action="{{ route('admin.subcategories.destroy', [$category, $subcategory]) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.subcategory_show', [$category, $subcategory]) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.subcategories.show', [$category, $subcategory]) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.subcategory_restore', [$category, $subcategory]) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.subcategories.edit', [$category, $subcategory]) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__subcategories">
                        <td colspan="8" class="no__subcategories_projects">{{ __('There are no subcategories') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($subcategories) || !empty($subcategories))
            <div class="pagination">{{ $subcategories->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
@endsection



