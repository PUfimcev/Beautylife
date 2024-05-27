<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'subject' => 'required|string|max:255',
            'subject_en' => 'required|string|max:255',
            'type' => 'required',
        ];
    }

    public function messages(): array
    {
        if(App::getLocale() !== 'en'){

            return [
                'subject_en.required' => 'Поле Subject in English обязательно',
                'type.required' => 'Поле тип обязательно',
            ];
        }

        return [
            'subject_en.required' => 'The Subject in English field is required.',
            'type.required' => 'The Type field is required.',
        ];

    }
}
