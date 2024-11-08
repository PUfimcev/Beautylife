<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class ConsumerRequest extends FormRequest
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
                 'name' => 'Consumer',
                 'name_en' => 'Consumer in Englis',
             ];
         }

         return [
             'code' => 'Код',
             'name' => 'Потребитель',
             'name_en' => 'Потребитель по Английски',
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
                 'name.required' => 'The Потребитель field is required',
                 'name.regex' => 'The Consumer field should be written in Russian letters',
                 'name_en.required' => 'The Consumer in Englis field is required',
                 'name_en.regex' => 'The Consumer in Englis field should be written in English letters',
             ];
         }

         return [
             'code.regex' => 'Поле Код должно быть написано латиницей',
             'name.required' => 'Поле Потребитель обязательно',
             'name.regex' => 'Поле Потребитель должно быть написано русскими буквами',
             'name_en.required' => 'Поле Consumer in Englis обязательно',
             'name_en.regex' => 'Поле Consumer in Englis должно быть написано латиницей',
         ];

     }
}