@extends('admin.layout.app')

@section('title', __('Skin types'))

@section('content')

<div class="container">
    <div class="admin__skintypes__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Skin types') }}</h2>

        @if (isset($archive))
        <a class="btn btn-warning skintype__create mt-3" href="{{ route('admin.skintypes.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success skintype__create" href="{{ route('admin.skintypes.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning skintype__create mt-3" href="{{ route('admin.skintype_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__skintypes">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($skintypes as $skintype)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="category__code">{{ $skintype->code }}</span></td>

                        <td><span class="category__name">{{ $skintype->langField('name') }}</span></td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.skintype_full_delete', $skintype) }}"
                            @else
                                action="{{ route('admin.skintypes.destroy', $skintype) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.skintype_show', $skintype) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.skintypes.show', $skintype) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.skintype_restore', $skintype) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.skintypes.edit', $skintype) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__skintypes">
                        <td colspan="8" class="no__skintypes_projects">{{ __('There are no categories') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($skintypes) || !empty($skintypes))
            <div class="pagination">{{ $skintypes->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
</div>

@endsection



