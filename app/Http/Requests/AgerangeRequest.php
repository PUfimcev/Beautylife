<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class AgerangeRequest extends FormRequest
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
            'code' => ['required', 'string', 'min:3', 'max:100','regex:/[0-9A-z - \+?]/'],
            'name' => ['required', 'string','min:3', 'max:250','regex:/[0-9А-я - \+]/'],
            'name_en' => ['required', 'string','min:3', 'max:250','regex:/[0-9A-z - \+]/'],
        ];
    }

    /**
     * attributes
     *
     * @return array
     */

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Age range',
                'name_en' => 'Age range in Englis',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Возрастной диапазон',
            'name_en' => 'Возрастной диапазон по Английски',
        ];
    }

    /**
     * messages
     *
     * @return array
     */

    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Возрастной диапазон field is required',
                'name.regex' => 'The Age range field should be written in Russian letters',
                'name_en.required' => 'The Age range in Englis field is required',
                'name_en.regex' => 'The Age range in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Возрастной диапазон обязательно',
            'name.regex' => 'Поле Возрастной диапазон должно быть написано русскими буквами',
            'name_en.required' => 'Поле Age range in Englis обязательно',
            'name_en.regex' => 'Поле Age range in Englis должно быть написано латиницей',
        ];

    }
}
