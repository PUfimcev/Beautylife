<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:100|regex:/[0-9А-я]/',
            'title_en' => 'required|string|max:100|regex:/[0-9A-z]/',
            'description' => 'required|string|regex:/[0-9А-я]/',
            'description_en' => 'required|string|regex:/[0-9A-z]/',
            'discount_size' => 'numeric|min:0|max:100|max_digits:3',
            'offerFile' => ['image', 'nullable'],
        ];

        if(empty($this->offer)) $rules['offerFile'][] = 'required';

        return $rules;

    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'title' => 'Title',
                'title_en' => 'Title in Englis',
                'description' => 'Description',
                'description_en' => 'Description in Englis',
                'offerFile' => 'Image',
                'discount_size' => 'Discount',
            ];
        }

        return [
            'title' => 'Заголовок',
            'title_en' => 'Заголовок по Английски',
            'description' => 'Описание',
            'description_en' => 'Описание по Английски',
            'offerFile' => 'Изображение',
            'discount_size' => 'Скидка',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'title.required' => 'The Заголовок field is required',
                'title_en.required' => 'The Title in English field is required',
                'description.required' => 'The Описание field is required',
                'description_en.required' => 'The Description in English field is required',
            ];
        }

        return [
            'title.required' => 'Поле Заголовок обязательно',
            'title_en.required' => 'Поле Title in English обязательно',
            'description.required' => 'Поле Описание обязательно',
            'description_en.required' => 'Поле Description in English обязательно',
        ];

    }
}
