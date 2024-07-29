@extends('admin.layout.app')

@section('title', isset($blog) ? __('Edit').' '.__('blog') :  __('Create').' '.__('review'))

@section('content')

<div class="container">

    <div class="admin__blogs__section-create d-flex flex-column align-items-center justify-content-start">

        <h2>{{ isset($blog) ? __('Edit') : __('Create') }} {{ __('blog') }}</h2>

        <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.blogs.index') }}">{{ __('Back') }}</a>


        <form method="POST"
            @if(isset($blog))
                action="{{ route('admin.blogs.update', $blog) }}"
            @else
                action="{{ route('admin.blogs.store') }}"
            @endif
            enctype="multipart/form-data" class="form_blog">

            @isset($blog)
                @method('PUT')
            @endisset
            @csrf


            <div class="blog__create mb-1">
                <label for="blog_title" class="col-form-label text-md-end">Заголовок:</label>
                <div class="blog_title_input">
                    <input id="blog_title" type="text" class="form-control @error('blog_title') is-invalid @enderror" name="blog_title" value="{{ old('blog_title', isset($blog) ? $blog->blog_title : null) }}"  autocomplete="blog_title" autofocus placeholder="Заголовок">
                    @error('blog_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_title_en" class="col-form-label text-md-end">Title in English:</label>
                <div class="blog_title_input">
                    <input id="blog_title_en" type="text" class="form-control @error('blog_title_en') is-invalid @enderror" name="blog_title_en" value="{{ old('blog_title_en', isset($blog) ? $blog->blog_title_en : null) }}"  autocomplete="blog_title_en" autofocus placeholder="Title in English">
                    @error('blog_title_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="slug" class="col-form-label text-md-end">{{ __('Title for adress bar') }}:</label>
                <div class="slug">
                    <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', isset($blog) ? $blog->slug  : null) }}"  autocomplete="slug" autofocus placeholder="in English letters">
                    @error('slug')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="blog__create mb-1">
                <label for="blogFile" class="col-form-label">{{ isset($blog) ? __('Change blog picture') : __('Blog picture') }}:</label>

                @if (isset($blog))
                    @if($blog->blog_image_route !== null)

                        <p>{{ __('The downloaded picture') }}:</p>
                        <img class="blog__image"
                        src="{{ asset('storage/'.$blog->blog_image_route) }}" alt="{{ __('Image') }}" />

                        <input class="form-control" type="file" id="blogFile" name="blogFile" value="{{ old('blogFile', isset($blog) ? $blog->blog_image_route : null) }}" accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @else
                        <p>{{ __('No picture') }}.</p>
                        <input class="form-control" type="file" id="blogFile" name="blogFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @endif
                @else

                    <input class="form-control @error('blogFile') is-invalid @enderror" type="file" id="blogFile" name="blogFile"  accept=".jpg, .jpeg,.png, .svg, .gif, .bmp" >
                    @error('blogFile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif

            </div>

            <div class="blog__create mb-1">
                <label for="blog_summary" class="col-form-label text-md-end">Аннотация блога:</label>

                <div class="blog_summary-1">
                    <textarea id="blog_summary" rows="6" class="form-control @error('blog_summary') is-invalid @enderror" name="blog_summary"  value="{{ old('blog_summary', isset($blog) ? $blog->blog_summary : null) }}" autofocus placeholder="Аннотация блога">{{ isset($blog) ? $blog->blog_summary : null }}</textarea>
                    @error('blog_summary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_summary_en" class="col-form-label text-md-end">Blog summary in English:</label>

                <div class="blog_summary_en-1">
                    <textarea id="blog_summary_en" rows="6" class="form-control @error('blog_summary_en') is-invalid @enderror" name="blog_summary_en"  value="{{ old('blog_summary_en', isset($blog) ? $blog->blog_summary_en : null) }}" autofocus placeholder="Blog summary in English">{{ isset($blog) ? $blog->blog_summary_en : null }}</textarea>
                    @error('blog_summary_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_1" class="col-form-label text-md-end">Подзаголовок блога 1:</label>

                <div class="blog_subtitle_1-1">
                    <input id="blog_subtitle_1" type="text" class="form-control @error('blog_subtitle_1') is-invalid @enderror" name="blog_subtitle_1"  value="{{ old('blog_subtitle_1', isset($blog) ? $blog->blog_subtitle_1 : null) }}" autofocus placeholder="Подзаголовок блога 1">
                    @error('blog_subtitle_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_1_en" class="col-form-label text-md-end">Blog subtitle 1 in English:</label>

                <div class="blog_subtitle_1_en-1">
                    <input id="blog_subtitle_1_en" type="text" class="form-control @error('blog_subtitle_1_en') is-invalid @enderror" name="blog_subtitle_1_en"  value="{{ old('blog_subtitle_1_en', isset($blog) ? $blog->blog_subtitle_1_en : null) }}" autofocus placeholder="Blog subtitle 1 in English">
                    @error('blog_subtitle_1_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_1" class="col-form-label text-md-end">Абзац блога 1:</label>

                <div class="blog_paragraph_1-1">
                    <textarea id="blog_paragraph_1" rows="6" class="form-control @error('blog_paragraph_1') is-invalid @enderror" name="blog_paragraph_1"  value="{{ old('blog_paragraph_1', isset($blog) ? $blog->blog_paragraph_1 : null) }}" autofocus placeholder="Абзац блога 1">{{ isset($blog) ? $blog->blog_paragraph_1 : null }}</textarea>
                    @error('blog_paragraph_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_1_en" class="col-form-label text-md-end">Blog paragraph 1 in English:</label>

                <div class="blog_paragraph_1_en-1">
                    <textarea id="blog_paragraph_1_en" rows="6" class="form-control @error('blog_paragraph_1_en') is-invalid @enderror" name="blog_paragraph_1_en"  value="{{ old('blog_paragraph_1_en', isset($blog) ? $blog->blog_paragraph_1_en : null) }}" autofocus placeholder="Blog paragraph 1 in English">{{ isset($blog) ? $blog->blog_paragraph_1_en : null }}</textarea>
                    @error('blog_paragraph_1_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_2" class="col-form-label text-md-end">Подзаголовок блога 2:</label>

                <div class="blog_subtitle_2-1">
                    <input id="blog_subtitle_2" type="text" class="form-control @error('blog_subtitle_2') is-invalid @enderror" name="blog_subtitle_2"  value="{{ old('blog_subtitle_2', isset($blog) ? $blog->blog_subtitle_2 : null) }}" autofocus placeholder="Подзаголовок блога 2">
                    @error('blog_subtitle_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_2_en" class="col-form-label text-md-end">Blog subtitle 2 in English:</label>

                <div class="blog_subtitle_2_en-1">
                    <input id="blog_subtitle_2_en" type="text" class="form-control @error('blog_subtitle_2_en') is-invalid @enderror" name="blog_subtitle_2_en"  value="{{ old('blog_subtitle_2_en', isset($blog) ? $blog->blog_subtitle_2_en : null) }}" autofocus placeholder="Blog subtitle 2 in English">
                    @error('blog_subtitle_2_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_2" class="col-form-label text-md-end">Абзац блога 2:</label>

                <div class="blog_paragraph_2-1">
                    <textarea id="blog_paragraph_2" rows="6" class="form-control @error('blog_paragraph_2') is-invalid @enderror" name="blog_paragraph_2"  value="{{ old('blog_paragraph_2', isset($blog) ? $blog->blog_paragraph_2 : null) }}" autofocus placeholder="Абзац блога 2">{{ isset($blog) ? $blog->blog_paragraph_2 : null }}</textarea>
                    @error('blog_paragraph_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_2_en" class="col-form-label text-md-end">Blog paragraph 2 in English:</label>

                <div class="blog_paragraph_2_en-1">
                    <textarea id="blog_paragraph_2_en" rows="6" class="form-control @error('blog_paragraph_2_en') is-invalid @enderror" name="blog_paragraph_2_en"  value="{{ old('blog_paragraph_2_en', isset($blog) ? $blog->blog_paragraph_2_en : null) }}" autofocus placeholder="Blog paragraph 2 in English">{{ isset($blog) ? $blog->blog_paragraph_2_en : null }}</textarea>
                    @error('blog_paragraph_2_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_3" class="col-form-label text-md-end">Подзаголовок блога 3:</label>

                <div class="blog_subtitle_3-1">
                    <input id="blog_subtitle_3" type="text" class="form-control @error('blog_subtitle_3') is-invalid @enderror" name="blog_subtitle_3"  value="{{ old('blog_subtitle_3', isset($blog) ? $blog->blog_subtitle_3 : null) }}" autofocus placeholder="Подзаголовок блога 3">
                    @error('blog_subtitle_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_3_en" class="col-form-label text-md-end">Blog subtitle 3 in English:</label>

                <div class="blog_subtitle_3_en-1">
                    <input id="blog_subtitle_3_en" type="text" class="form-control @error('blog_subtitle_3_en') is-invalid @enderror" name="blog_subtitle_3_en"  value="{{ old('blog_subtitle_3_en', isset($blog) ? $blog->blog_subtitle_3_en : null) }}" autofocus placeholder="Blog subtitle 3 in English">
                    @error('blog_subtitle_3_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_3" class="col-form-label text-md-end">Абзац блога 3:</label>

                <div class="blog_paragraph_3-1">
                    <textarea id="blog_paragraph_3" rows="6" class="form-control @error('blog_paragraph_3') is-invalid @enderror" name="blog_paragraph_3"  value="{{ old('blog_paragraph_3', isset($blog) ? $blog->blog_paragraph_3 : null) }}" autofocus placeholder="Абзац блога 3">{{ isset($blog) ? $blog->blog_paragraph_3 : null }}</textarea>
                    @error('blog_paragraph_3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_3_en" class="col-form-label text-md-end">Blog paragraph 3 in English:</label>

                <div class="blog_paragraph_3_en-1">
                    <textarea id="blog_paragraph_3_en" rows="6" class="form-control @error('blog_paragraph_3_en') is-invalid @enderror" name="blog_paragraph_3_en"  value="{{ old('blog_paragraph_3_en', isset($blog) ? $blog->blog_paragraph_3_en : null) }}" autofocus placeholder="Blog paragraph 3 in English">{{ isset($blog) ? $blog->blog_paragraph_3_en : null }}</textarea>
                    @error('blog_paragraph_3_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_4" class="col-form-label text-md-end">Подзаголовок блога 4:</label>

                <div class="blog_subtitle_4-1">
                    <input id="blog_subtitle_4" type="text" class="form-control @error('blog_subtitle_4') is-invalid @enderror" name="blog_subtitle_4"  value="{{ old('blog_subtitle_4', isset($blog) ? $blog->blog_subtitle_4 : null) }}" autofocus placeholder="Подзаголовок блога 4">
                    @error('blog_subtitle_4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_4_en" class="col-form-label text-md-end">Blog subtitle 4 in English:</label>

                <div class="blog_subtitle_4_en-1">
                    <input id="blog_subtitle_4_en" type="text" class="form-control @error('blog_subtitle_4_en') is-invalid @enderror" name="blog_subtitle_4_en"  value="{{ old('blog_subtitle_4_en', isset($blog) ? $blog->blog_subtitle_4_en : null) }}" autofocus placeholder="Blog subtitle 4 in English">
                    @error('blog_subtitle_4_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_4" class="col-form-label text-md-end">Абзац блога 4:</label>

                <div class="blog_paragraph_4-1">
                    <textarea id="blog_paragraph_4" rows="6" class="form-control @error('blog_paragraph_4') is-invalid @enderror" name="blog_paragraph_4"  value="{{ old('blog_paragraph_4', isset($blog) ? $blog->blog_paragraph_4 : null) }}" autofocus placeholder="Абзац блога 4">{{ isset($blog) ? $blog->blog_paragraph_4 : null }}</textarea>
                    @error('blog_paragraph_4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_4_en" class="col-form-label text-md-end">Blog paragraph 4 in English:</label>

                <div class="blog_paragraph_4_en-1">
                    <textarea id="blog_paragraph_4_en" rows="6" class="form-control @error('blog_paragraph_4_en') is-invalid @enderror" name="blog_paragraph_4_en"  value="{{ old('blog_paragraph_4_en', isset($blog) ? $blog->blog_paragraph_4_en : null) }}" autofocus placeholder="Blog paragraph 4 in English">{{ isset($blog) ? $blog->blog_paragraph_4_en : null }}</textarea>
                    @error('blog_paragraph_4_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_5" class="col-form-label text-md-end">Подзаголовок блога 5:</label>

                <div class="blog_subtitle_5-1">
                    <input id="blog_subtitle_5" type="text" class="form-control @error('blog_subtitle_5') is-invalid @enderror" name="blog_subtitle_5"  value="{{ old('blog_subtitle_5', isset($blog) ? $blog->blog_subtitle_5 : null) }}" autofocus placeholder="Подзаголовок блога 5">
                    @error('blog_subtitle_5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_5_en" class="col-form-label text-md-end">Blog subtitle 5 in English:</label>

                <div class="blog_subtitle_5_en-1">
                    <input id="blog_subtitle_5_en" type="text" class="form-control @error('blog_subtitle_5_en') is-invalid @enderror" name="blog_subtitle_5_en"  value="{{ old('blog_subtitle_5_en', isset($blog) ? $blog->blog_subtitle_5_en : null) }}" autofocus placeholder="Blog subtitle 5 in English">
                    @error('blog_subtitle_5_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_5" class="col-form-label text-md-end">Абзац блога 5:</label>

                <div class="blog_paragraph_5-1">
                    <textarea id="blog_paragraph_5" rows="6" class="form-control @error('blog_paragraph_5') is-invalid @enderror" name="blog_paragraph_5"  value="{{ old('blog_paragraph_5', isset($blog) ? $blog->blog_paragraph_5 : null) }}" autofocus placeholder="Абзац блога 5">{{ isset($blog) ? $blog->blog_paragraph_5 : null }}</textarea>
                    @error('blog_paragraph_5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_5_en" class="col-form-label text-md-end">Blog paragraph 5 in English:</label>

                <div class="blog_paragraph_5_en-1">
                    <textarea id="blog_paragraph_5_en" rows="6" class="form-control @error('blog_paragraph_5_en') is-invalid @enderror" name="blog_paragraph_5_en"  value="{{ old('blog_paragraph_5_en', isset($blog) ? $blog->blog_paragraph_5_en : null) }}" autofocus placeholder="Blog paragraph 5 in English">{{ isset($blog) ? $blog->blog_paragraph_5_en : null }}</textarea>
                    @error('blog_paragraph_5_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_6" class="col-form-label text-md-end">Подзаголовок блога 6:</label>

                <div class="blog_subtitle_6-1">
                    <input id="blog_subtitle_6" type="text" class="form-control @error('blog_subtitle_6') is-invalid @enderror" name="blog_subtitle_6"  value="{{ old('blog_subtitle_6', isset($blog) ? $blog->blog_subtitle_6 : null) }}" autofocus placeholder="Подзаголовок блога 6">
                    @error('blog_subtitle_6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_6_en" class="col-form-label text-md-end">Blog subtitle 6 in English:</label>

                <div class="blog_subtitle_6_en-1">
                    <input id="blog_subtitle_6_en" type="text" class="form-control @error('blog_subtitle_6_en') is-invalid @enderror" name="blog_subtitle_6_en"  value="{{ old('blog_subtitle_6_en', isset($blog) ? $blog->blog_subtitle_6_en : null) }}" autofocus placeholder="Blog subtitle 6 in English">
                    @error('blog_subtitle_6_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_6" class="col-form-label text-md-end">Абзац блога 6:</label>

                <div class="blog_paragraph_6-1">
                    <textarea id="blog_paragraph_6" rows="6" class="form-control @error('blog_paragraph_6') is-invalid @enderror" name="blog_paragraph_6"  value="{{ old('blog_paragraph_6', isset($blog) ? $blog->blog_paragraph_6 : null) }}" autofocus placeholder="Абзац блога 6">{{ isset($blog) ? $blog->blog_paragraph_6 : null }}</textarea>
                    @error('blog_paragraph_6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_6_en" class="col-form-label text-md-end">Blog paragraph 6 in English:</label>

                <div class="blog_paragraph_6_en-1">
                    <textarea id="blog_paragraph_6_en" rows="6" class="form-control @error('blog_paragraph_6_en') is-invalid @enderror" name="blog_paragraph_6_en"  value="{{ old('blog_paragraph_6_en', isset($blog) ? $blog->blog_paragraph_6_en : null) }}" autofocus placeholder="Blog paragraph 6 in English">{{ isset($blog) ? $blog->blog_paragraph_6_en : null }}</textarea>
                    @error('blog_paragraph_6_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_7" class="col-form-label text-md-end">Подзаголовок блога 7:</label>

                <div class="blog_subtitle_7-1">
                    <input id="blog_subtitle_7" type="text" class="form-control @error('blog_subtitle_7') is-invalid @enderror" name="blog_subtitle_7"  value="{{ old('blog_subtitle_7', isset($blog) ? $blog->blog_subtitle_7 : null) }}" autofocus placeholder="Подзаголовок блога 7">
                    @error('blog_subtitle_7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_7_en" class="col-form-label text-md-end">Blog subtitle 7 in English:</label>

                <div class="blog_subtitle_7_en-1">
                    <input id="blog_subtitle_7_en" type="text" class="form-control @error('blog_subtitle_7_en') is-invalid @enderror" name="blog_subtitle_7_en"  value="{{ old('blog_subtitle_7_en', isset($blog) ? $blog->blog_subtitle_7_en : null) }}" autofocus placeholder="Blog subtitle 7 in English">
                    @error('blog_subtitle_7_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_7" class="col-form-label text-md-end">Абзац блога 7:</label>

                <div class="blog_paragraph_7-1">
                    <textarea id="blog_paragraph_7" rows="6" class="form-control @error('blog_paragraph_7') is-invalid @enderror" name="blog_paragraph_7"  value="{{ old('blog_paragraph_7', isset($blog) ? $blog->blog_paragraph_7 : null) }}" autofocus placeholder="Абзац блога 7">{{ isset($blog) ? $blog->blog_paragraph_7 : null }}</textarea>
                    @error('blog_paragraph_7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_7_en" class="col-form-label text-md-end">Blog paragraph 7 in English:</label>

                <div class="blog_paragraph_7_en-1">
                    <textarea id="blog_paragraph_7_en" rows="6" class="form-control @error('blog_paragraph_7_en') is-invalid @enderror" name="blog_paragraph_7_en"  value="{{ old('blog_paragraph_7_en', isset($blog) ? $blog->blog_paragraph_7_en : null) }}" autofocus placeholder="Blog paragraph 7 in English">{{ isset($blog) ? $blog->blog_paragraph_7_en : null }}</textarea>
                    @error('blog_paragraph_7_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_8" class="col-form-label text-md-end">Подзаголовок блога 8:</label>

                <div class="blog_subtitle_8-1">
                    <input id="blog_subtitle_8" type="text" class="form-control @error('blog_subtitle_8') is-invalid @enderror" name="blog_subtitle_8"  value="{{ old('blog_subtitle_8', isset($blog) ? $blog->blog_subtitle_8 : null) }}" autofocus placeholder="Подзаголовок блога 8">
                    @error('blog_subtitle_8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_8_en" class="col-form-label text-md-end">Blog subtitle 8 in English:</label>

                <div class="blog_subtitle_8_en-1">
                    <input id="blog_subtitle_8_en" type="text" class="form-control @error('blog_subtitle_8_en') is-invalid @enderror" name="blog_subtitle_8_en"  value="{{ old('blog_subtitle_8_en', isset($blog) ? $blog->blog_subtitle_8_en : null) }}" autofocus placeholder="Blog subtitle 8 in English">
                    @error('blog_subtitle_8_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_8" class="col-form-label text-md-end">Абзац блога 8:</label>

                <div class="blog_paragraph_8-1">
                    <textarea id="blog_paragraph_8" rows="6" class="form-control @error('blog_paragraph_8') is-invalid @enderror" name="blog_paragraph_8"  value="{{ old('blog_paragraph_8', isset($blog) ? $blog->blog_paragraph_8 : null) }}" autofocus placeholder="Абзац блога 8">{{ isset($blog) ? $blog->blog_paragraph_8 : null }}</textarea>
                    @error('blog_paragraph_8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_8_en" class="col-form-label text-md-end">Blog paragraph 8 in English:</label>

                <div class="blog_paragraph_8_en-1">
                    <textarea id="blog_paragraph_8_en" rows="6" class="form-control @error('blog_paragraph_8_en') is-invalid @enderror" name="blog_paragraph_8_en"  value="{{ old('blog_paragraph_8_en', isset($blog) ? $blog->blog_paragraph_8_en : null) }}" autofocus placeholder="Blog paragraph 8 in English">{{ isset($blog) ? $blog->blog_paragraph_8_en : null }}</textarea>
                    @error('blog_paragraph_8_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_9" class="col-form-label text-md-end">Подзаголовок блога 9:</label>

                <div class="blog_subtitle_9-1">
                    <input id="blog_subtitle_9" type="text" class="form-control @error('blog_subtitle_9') is-invalid @enderror" name="blog_subtitle_9"  value="{{ old('blog_subtitle_9', isset($blog) ? $blog->blog_subtitle_9 : null) }}" autofocus placeholder="Подзаголовок блога 9">
                    @error('blog_subtitle_9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_9_en" class="col-form-label text-md-end">Blog subtitle 9 in English:</label>

                <div class="blog_subtitle_9_en-1">
                    <input id="blog_subtitle_9_en" type="text" class="form-control @error('blog_subtitle_9_en') is-invalid @enderror" name="blog_subtitle_9_en"  value="{{ old('blog_subtitle_9_en', isset($blog) ? $blog->blog_subtitle_9_en : null) }}" autofocus placeholder="Blog subtitle 9 in English">
                    @error('blog_subtitle_9_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_9" class="col-form-label text-md-end">Абзац блога 9:</label>

                <div class="blog_paragraph_9-1">
                    <textarea id="blog_paragraph_9" rows="6" class="form-control @error('blog_paragraph_9') is-invalid @enderror" name="blog_paragraph_9"  value="{{ old('blog_paragraph_9', isset($blog) ? $blog->blog_paragraph_9 : null) }}" autofocus placeholder="Абзац блога 9">{{ isset($blog) ? $blog->blog_paragraph_9 : null }}</textarea>
                    @error('blog_paragraph_9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_9_en" class="col-form-label text-md-end">Blog paragraph 9 in English:</label>

                <div class="blog_paragraph_9_en-1">
                    <textarea id="blog_paragraph_9_en" rows="6" class="form-control @error('blog_paragraph_9_en') is-invalid @enderror" name="blog_paragraph_9_en"  value="{{ old('blog_paragraph_9_en', isset($blog) ? $blog->blog_paragraph_9_en : null) }}" autofocus placeholder="Blog paragraph 9 in English">{{ isset($blog) ? $blog->blog_paragraph_9_en : null }}</textarea>
                    @error('blog_paragraph_9_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_10" class="col-form-label text-md-end">Подзаголовок блога 10:</label>

                <div class="blog_subtitle_10-1">
                    <input id="blog_subtitle_10" type="text" class="form-control @error('blog_subtitle_10') is-invalid @enderror" name="blog_subtitle_10"  value="{{ old('blog_subtitle_10', isset($blog) ? $blog->blog_subtitle_10 : null) }}" autofocus placeholder="Подзаголовок блога 10">
                    @error('blog_subtitle_10')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_subtitle_10_en" class="col-form-label text-md-end">Blog subtitle 10 in English:</label>

                <div class="blog_subtitle_10_en-1">
                    <input id="blog_subtitle_10_en" type="text" class="form-control @error('blog_subtitle_10_en') is-invalid @enderror" name="blog_subtitle_10_en"  value="{{ old('blog_subtitle_10_en', isset($blog) ? $blog->blog_subtitle_10_en : null) }}" autofocus placeholder="Blog subtitle 10 in English">
                    @error('blog_subtitle_10_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_10" class="col-form-label text-md-end">Абзац блога 10:</label>

                <div class="blog_paragraph_10-1">
                    <textarea id="blog_paragraph_10" rows="6" class="form-control @error('blog_paragraph_10') is-invalid @enderror" name="blog_paragraph_10"  value="{{ old('blog_paragraph_10', isset($blog) ? $blog->blog_paragraph_10 : null) }}" autofocus placeholder="Абзац блога 10">{{ isset($blog) ? $blog->blog_paragraph_10 : null }}</textarea>
                    @error('blog_paragraph_10')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="blog__create mb-1">
                <label for="blog_paragraph_10_en" class="col-form-label text-md-end">Blog paragraph 10 in English:</label>

                <div class="blog_paragraph_10_en-1">
                    <textarea id="blog_paragraph_10_en" rows="6" class="form-control @error('blog_paragraph_10_en') is-invalid @enderror" name="blog_paragraph_10_en"  value="{{ old('blog_paragraph_10_en', isset($blog) ? $blog->blog_paragraph_10_en : null) }}" autofocus placeholder="Blog paragraph 10 in English">{{ isset($blog) ? $blog->blog_paragraph_10_en : null }}</textarea>
                    @error('blog_paragraph_10_en')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <button type="submit" onClick="()=> {submit()}" class="btn btn-success align-self-center btn__blog__form-create" href="">{{ isset($blog) ? __('Edit') : __('Create') }}</button>
        </form>


    </div>
</div>

@endsection


