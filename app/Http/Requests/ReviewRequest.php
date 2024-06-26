<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'reviewer_name' => 'required|string|max:255',
            'evaluation' => 'required|numeric|decimal:0,1|max:5|min:0|regex:/[0-5]?/',
            'review_content' => 'required|min:5',
            'reviewFile' => 'image|nullable',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        if(App::getLocale() !== 'en'){

            return [
                'reviewer_name' => 'имя',
                'evaluation' => 'оценка',
                'review_content' => 'содержание отзыва',
            ];
        }
        return [
            'reviewer_name' => 'name',
        ];
    }

}
