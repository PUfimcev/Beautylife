<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'code' => ['required', 'string', 'min:3', 'max:100','regex:/[0-9A-z]/'],
            'name' => ['required', 'string','min:3', 'max:250','regex:/[0-9А-я]/'],
            'name_en' => ['required', 'string','min:3', 'max:250','regex:/[0-9A-z]/'],
            'categoryFile' => ['image', 'nullable'],
        ];

        if(!empty($this->category)) {
            $rules['code'][] = Rule::unique('categories')->ignore($this->category->id);
            $rules['name'][] = Rule::unique('categories')->ignore($this->category->id);
            $rules['name_en'][] = Rule::unique('categories')->ignore($this->category->id);
        } else {
            $rules['code'][] = Rule::unique('categories');
            $rules['name'][] = Rule::unique('categories');
            $rules['name_en'][] = Rule::unique('categories');
            $rules['categoryFile'][] = 'required';
        }

        return $rules;
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Category name',
                'name_en' => 'Category name in Englis',
                'categoryFile' => 'Image',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Название категории',
            'name_en' => 'Название категории по Английски',
            'categoryFile' => 'Изображение',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Название категории field is required',
                'name.regex' => 'The Category name field should be written in Russian letters',
                'name_en.required' => 'The Category name in Englis field is required',
                'name_en.regex' => 'The Category name in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Название категории обязательно',
            'name.regex' => 'Поле Category name должно быть написано русскими буквами',
            'name_en.required' => 'Поле Category name in Englis обязательно',
            'name_en.regex' => 'Поле Category name in Englis должно быть написано латиницей',
        ];

    }
}
