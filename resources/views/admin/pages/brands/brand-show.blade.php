@extends('admin.layout.app')

@section('title', __('Brand'))

@section('content')

<div class="container">

    <div class="admin__brand__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        <h2>{{ __('Brand') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.brands.index') }}">{{ __('Back') }}</a>

        <div class="brand_details">
            <ul class="brand_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $brand->id }}</span></li>

                <li><span class="details-name">{{ __('Brand name') }}: </span><span class="details-content">{{ $brand->brand_name }}</span></li>
                <li></li>
                <li><span class="details-name">Аннотация бренда: </span><span class="details-content">{{ $brand->brand_about }}</span></li>
                <li></li>
                <li><span class="details-name">Brand summary in English: </span><span class="details-content">{{ empty($brand->brand_about_en) ?   __('No')  : $brand->brand_about_en }}</span></li>
                <li></li>
                <li><span class="details-name">{{ __('Brand logo') }}: </span><span class="details-content">@if($brand->brand_image_route)
                    <img class="brand__image"
                    src="{{ asset('storage/'.$brand->brand_image_route) }}" alt="{{ __('Brand logo') }}" />
                @else
                    {{  __('No') }}.
                @endif</span></li>

                <li></li>
                <li><span class="details-name">Описание бренда: </span><span class="details-content">@empty($brand->brand_description) {{ __('No') }} @endempty @php echo html_entity_decode($brand->brand_description); @endphp</span></li>
                <li></li>
                <li><span class="details-name">Brand description in English: </span><span class="details-content">@empty($brand->brand_description) {{ __('No') }} @endempty @php echo html_entity_decode($brand->brand_description_en); @endphp</span></li>
                <li></li>
                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $brand->created_at }}</span></li>
                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $brand->updated_at }}</span></li>



            </ul>
        </div>

        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" href="{{ route('admin.brands.edit', $brand) }}"><span>{{ __('Edit') }}</span></a>
            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
