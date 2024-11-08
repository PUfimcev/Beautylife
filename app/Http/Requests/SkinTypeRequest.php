<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class SkinTypeRequest extends FormRequest
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
            'code' => ['required', 'string', 'min:3', 'max:100','regex:/[0-9A-z]/'],
            'name' => ['required', 'string','min:3', 'max:250','regex:/[0-9А-я]/'],
            'name_en' => ['required', 'string','min:3', 'max:250','regex:/[0-9A-z]/'],
        ];
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Skin type',
                'name_en' => 'Skin type in Englis',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Тип кожи',
            'name_en' => 'Тип кожи по Английски',
        ];
    }


    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Тип кожи field is required',
                'name.regex' => 'The Skin type field should be written in Russian letters',
                'name_en.required' => 'The Skin type in Englis field is required',
                'name_en.regex' => 'The Skin type in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Тип кожи обязательно',
            'name.regex' => 'Поле Skin type должно быть написано русскими буквами',
            'name_en.required' => 'Поле Skin type in Englis обязательно',
            'name_en.regex' => 'Поле Skin type in Englis должно быть написано латиницей',
        ];

    }

}
