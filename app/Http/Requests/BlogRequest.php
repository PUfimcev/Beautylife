<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'blog_title' => 'required|string|max:455',
            'blog_title_en' => 'required|string|max:455',
            'slug' => ['required', 'string', 'min:3', 'max:255', 'regex:/[0-9A-z]/'],
            'blog_paragraph_1' => 'required|string',
            'blogFile' => ['image', 'nullable'],
        ];

        if(!empty($this->blog)) {
            $rules['slug'][] = Rule::unique('blogs')->ignore($this->blog->id);
        } else {
            $rules['slug'][] = Rule::unique('blogs');
            $rules['blogFile'][] = 'required';
        }

        return $rules;

    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'slug' => 'Title for adress bar',
                'blogFile' => 'Image',
            ];
        }

        return [
            'slug' => 'Заголовок для адрессной строки',
            'blogFile' => 'Изображение',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'blog_title.required' => 'The Заголовок field is required',
                'blog_title_en.required' => 'The Title in English field is required',
                'blog_paragraph_1_en.required' => 'The Blog paragraph 1 in English field is required',
            ];
        }

        return [
            'blog_title.required' => 'Поле Заголовок обязательно',
            'blog_title_en.required' => 'Поле Title in English обязательно',
            'blog_paragraph_1.required' => 'Поле Абзац блога 1 обязательно',
        ];

    }
}
