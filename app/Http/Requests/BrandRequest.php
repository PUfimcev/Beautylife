<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        return [
            'brand_name' => 'required|string|max:455',
            'brand_about' => 'required|string',
            'blogFile' => ['image', 'nullable'],
        ];
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'blogFile' => 'Logo',
            ];
        }

        return [
            'blogFile' => 'Логотип',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'brand_name.required' => 'The Brand name field is required',
                'brand_about.required' => 'The Аннотация бренда field is required',
            ];
        }

        return [
            'brand_name.required' => 'Поле Название бренда обязательно',
            'brand_about.required' => 'Поле Аннотация бренда обязательно',
        ];

    }
}
