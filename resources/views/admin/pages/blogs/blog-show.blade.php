@extends('admin.layout.app')

@section('title', __('Blog'))

@section('content')

<div class="container">

    <div class="admin__blog__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        <h2>{{ __('Blog') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.blogs.index') }}">{{ __('Back') }}</a>

        <div class="blog_details">
            <ul class="blog_details_list">
                <li><span class="details-name">id:</span><span class="details-content">{{ $blog->id }}</span></li>
                <li><span class="details-name">{{ __('Image') }}: </span><span class="details-content">@if($blog->blog_image_route)
                    <img class="blog__image"
                    src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}" />
                @else
                    {{  __('No') }}.
                @endif</span></li>

                <li><span class="details-name">Заголовок: </span><span class="details-content">{{ empty($blog->blog_title) ?   __('No')  : $blog->blog_title }}</span></li>
                <li><span class="details-name">Title in English: </span><span class="details-content">{{ empty($blog->blog_title_en) ?   __('No')  : $blog->blog_title_en }}</span></li>

                <li><span class="details-name">Аннотация блога: </span><span class="details-content">{{ empty($blog->blog_summary) ?   __('No')  : $blog->blog_summary }}</span></li>
                <li><span class="details-name">Blog summary in English: </span><span class="details-content">{{ empty($blog->blog_summary_en) ?   __('No')  : $blog->blog_summary_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 1: </span><span class="details-content">{{ empty($blog->blog_subtitle_1) ?   __('No')  : $blog->blog_subtitle_1 }}</span></li>
                <li><span class="details-name">Blog subtitle 1 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_1_en) ?   __('No')  : $blog->blog_subtitle_1_en }}</span></li>

                <li><span class="details-name">Абзац блога 1: </span><span class="details-content">{{ empty($blog->blog_paragraph_1) ?   __('No')  : $blog->blog_paragraph_1 }}</span></li>
                <li><span class="details-name">Blog paragraph 1 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_1_en) ?   __('No')  : $blog->blog_paragraph_1_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 2: </span><span class="details-content">{{ empty($blog->blog_subtitle_2) ?   __('No')  : $blog->blog_subtitle_2 }}</span></li>
                <li><span class="details-name">Blog subtitle 2 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_2_en) ?   __('No')  : $blog->blog_subtitle_2_en }}</span></li>

                <li><span class="details-name">Абзац блога 2: </span><span class="details-content">{{ empty($blog->blog_paragraph_2) ?   __('No')  : $blog->blog_paragraph_2 }}</span></li>
                <li><span class="details-name">Blog paragraph 2 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_2_en) ?   __('No')  : $blog->blog_paragraph_2_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 3: </span><span class="details-content">{{ empty($blog->blog_subtitle_3) ?   __('No')  : $blog->blog_subtitle_3 }}</span></li>
                <li><span class="details-name">Blog subtitle 3 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_3_en) ?   __('No')  : $blog->blog_subtitle_3_en }}</span></li>

                <li><span class="details-name">Абзац блога 3: </span><span class="details-content">{{ empty($blog->blog_paragraph_3) ?   __('No')  : $blog->blog_paragraph_3 }}</span></li>
                <li><span class="details-name">Blog paragraph 3 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_3_en) ?   __('No')  : $blog->blog_paragraph_3_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 4: </span><span class="details-content">{{ empty($blog->blog_subtitle_4) ?   __('No')  : $blog->blog_subtitle_4 }}</span></li>
                <li><span class="details-name">Blog subtitle 4 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_4_en) ?   __('No')  : $blog->blog_subtitle_4_en }}</span></li>

                <li><span class="details-name">Абзац блога 4: </span><span class="details-content">{{ empty($blog->blog_paragraph_4) ?   __('No')  : $blog->blog_paragraph_4 }}</span></li>
                <li><span class="details-name">Blog paragraph 4 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_4_en) ?   __('No')  : $blog->blog_paragraph_4_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 5: </span><span class="details-content">{{ empty($blog->blog_subtitle_5) ?   __('No')  : $blog->blog_subtitle_5 }}</span></li>
                <li><span class="details-name">Blog subtitle 5 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_5_en) ?   __('No')  : $blog->blog_subtitle_5_en }}</span></li>

                <li><span class="details-name">Абзац блога 5: </span><span class="details-content">{{ empty($blog->blog_paragraph_5) ?   __('No')  : $blog->blog_paragraph_5 }}</span></li>
                <li><span class="details-name">Blog paragraph 5 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_5_en) ?   __('No')  : $blog->blog_paragraph_5_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 6: </span><span class="details-content">{{ empty($blog->blog_subtitle_6) ?   __('No')  : $blog->blog_subtitle_6 }}</span></li>
                <li><span class="details-name">Blog subtitle 6 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_6_en) ?   __('No')  : $blog->blog_subtitle_6_en }}</span></li>

                <li><span class="details-name">Абзац блога 6: </span><span class="details-content">{{ empty($blog->blog_paragraph_6) ?   __('No')  : $blog->blog_paragraph_6 }}</span></li>
                <li><span class="details-name">Blog paragraph 6 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_6_en) ?   __('No')  : $blog->blog_paragraph_6_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 7: </span><span class="details-content">{{ empty($blog->blog_subtitle_7) ?   __('No')  : $blog->blog_subtitle_7 }}</span></li>
                <li><span class="details-name">Blog subtitle 7 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_7_en) ?   __('No')  : $blog->blog_subtitle_7_en }}</span></li>

                <li><span class="details-name">Абзац блога 7: </span><span class="details-content">{{ empty($blog->blog_paragraph_7) ?   __('No')  : $blog->blog_paragraph_7 }}</span></li>
                <li><span class="details-name">Blog paragraph 7 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_7_en) ?   __('No')  : $blog->blog_paragraph_7_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 8: </span><span class="details-content">{{ empty($blog->blog_subtitle_8) ?   __('No')  : $blog->blog_subtitle_8 }}</span></li>
                <li><span class="details-name">Blog subtitle 8 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_8_en) ?   __('No')  : $blog->blog_subtitle_8_en }}</span></li>

                <li><span class="details-name">Абзац блога 8: </span><span class="details-content">{{ empty($blog->blog_paragraph_8) ?   __('No')  : $blog->blog_paragraph_8 }}</span></li>
                <li><span class="details-name">Blog paragraph 8 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_8_en) ?   __('No')  : $blog->blog_paragraph_8_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 9: </span><span class="details-content">{{ empty($blog->blog_subtitle_9) ?   __('No')  : $blog->blog_subtitle_9 }}</span></li>
                <li><span class="details-name">Blog subtitle 9 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_9_en) ?   __('No')  : $blog->blog_subtitle_9_en }}</span></li>

                <li><span class="details-name">Абзац блога 9: </span><span class="details-content">{{ empty($blog->blog_paragraph_9) ?   __('No')  : $blog->blog_paragraph_9 }}</span></li>
                <li><span class="details-name">Blog paragraph 9 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_9_en) ?   __('No')  : $blog->blog_paragraph_9_en }}</span></li>

                <li><span class="details-name">Подзаголовок блога 10: </span><span class="details-content">{{ empty($blog->blog_subtitle_10) ?   __('No')  : $blog->blog_subtitle_10 }}</span></li>
                <li><span class="details-name">Blog subtitle 10 in English: </span><span class="details-content">{{ empty($blog->blog_subtitle_10_en) ?   __('No')  : $blog->blog_subtitle_10_en }}</span></li>

                <li><span class="details-name">Абзац блога 10: </span><span class="details-content">{{ empty($blog->blog_paragraph_10) ?   __('No')  : $blog->blog_paragraph_10 }}</span></li>
                <li><span class="details-name">Blog paragraph 10 in English: </span><span class="details-content">{{ empty($blog->blog_paragraph_10_en) ?   __('No')  : $blog->blog_paragraph_10_en }}</span></li>


                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $blog->created_at }}</span></li>
                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $blog->updated_at }}</span></li>



            </ul>
        </div>

        <form method="POST" action="{{ route('admin.blogs.destroy', $blog->slug) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" href="{{ route('admin.blogs.edit', $blog->slug) }}"><span>{{ __('Edit') }}</span></a>
            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
