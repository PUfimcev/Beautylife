@extends('admin.layout.app')

@section('title', __('Age ranges'))

@section('content')

<div class="container">
    <div class="admin__ageranges__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Age ranges') }}</h2>

        @if (isset($archive))
        <a class="btn btn-warning agerange__create mt-3" href="{{ route('admin.ageranges.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success agerange__create" href="{{ route('admin.ageranges.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning agerange__create mt-3" href="{{ route('admin.agerange_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__ageranges">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($ageranges as $agerange)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="category__code">{{ $agerange->code }}</span></td>

                        <td><span class="category__name">{{ $agerange->langField('name') }}</span></td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.agerange_full_delete', $agerange) }}"
                            @else
                                action="{{ route('admin.ageranges.destroy', $agerange) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.agerange_show', $agerange) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.ageranges.show', $agerange) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.agerange_restore', $agerange) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.ageranges.edit', $agerange) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__ageranges">
                        <td colspan="8" class="no__ageranges_projects">{{ __('There are no categories') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($ageranges) || !empty($ageranges))
            <div class="pagination">{{ $ageranges->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
</div>

@endsection



