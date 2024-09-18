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
        ];

        if(!empty($this->category)) {
            $rules['code'][] = Rule::unique('categories')->ignore($this->category->id);
            $rules['name'][] = Rule::unique('categories')->ignore($this->category->id);
            $rules['name_en'][] = Rule::unique('categories')->ignore($this->category->id);
        } else {
            $rules['code'][] = Rule::unique('categories');
            $rules['name'][] = Rule::unique('categories');
            $rules['name_en'][] = Rule::unique('categories');
        }

        return $rules;
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Name',
                'name_en' => 'Name in Englis',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Наименование',
            'name_en' => 'Наименование по Английски',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Наименование field is required',
                'name.regex' => 'The Name field should be written in Russian letters',
                'name_en.required' => 'The Name in Englis field is required',
                'name_en.regex' => 'The Name in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Наименование обязательно',
            'name.regex' => 'Поле Name должно быть написано русскими буквами',
            'name_en.required' => 'Поле Name in Englis обязательно',
            'name_en.regex' => 'Поле Name in Englis должно быть написано латиницей',
        ];

    }
}
