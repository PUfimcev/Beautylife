<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
        ];

        if(!empty($this->subcategory)) {
            $rules['code'][] = Rule::unique('subcategories')->ignore($this->subcategory->id);
            $rules['name'][] = Rule::unique('subcategories')->ignore($this->subcategory->id);
            $rules['name_en'][] = Rule::unique('subcategories')->ignore($this->subcategory->id);
        } else {
            $rules['code'][] = Rule::unique('subcategories');
            $rules['name'][] = Rule::unique('subcategories');
            $rules['name_en'][] = Rule::unique('subcategories');
        }

        return $rules;
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Subcategory name',
                'name_en' => 'Subcategory name in Englis',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Название подкатегории',
            'name_en' => 'Название подкатегории по Английски',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Название подкатегории field is required',
                'name.regex' => 'The Subcategory name field should be written in Russian letters',
                'name_en.required' => 'The Subcategory name in Englis field is required',
                'name_en.regex' => 'The Subcategory name in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Название подкатегории обязательно',
            'name.regex' => 'Поле Subcategory name должно быть написано русскими буквами',
            'name_en.required' => 'Поле Subcategory name in Englis обязательно',
            'name_en.regex' => 'Поле Subcategory name in Englis должно быть написано латиницей',
        ];

    }
}
