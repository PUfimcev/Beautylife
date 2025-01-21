<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string','min:3', 'max:250'],
            'name_en' => ['required', 'string','min:3', 'max:250','regex:/[0-9A-z]/'],
            'productPictures' => ['image', 'nullable'],
            'subcategory_id' => ['required'],
            'brand_id' => ['required'],
            'skin_type_id' => ['required'],
            'agerange_id' => ['required'],
            'consumer_id' => ['required'],
        ];

        if(!empty($this->product)) {
            $rules['code'][] = Rule::unique('products')->ignore($this->product->id);
            $rules['name'][] = Rule::unique('products')->ignore($this->product->id);
            $rules['name_en'][] = Rule::unique('products')->ignore($this->product->id);
        } else {
            $rules['code'][] = Rule::unique('products');
            $rules['name'][] = Rule::unique('products');
            $rules['name_en'][] = Rule::unique('products');
        }

        return $rules;
    }

    public function attributes(): array
    {
        if(App::getLocale() === 'en'){
            return [
                'code' => 'Code',
                'name' => 'Product name',
                'name_en' => 'Product name in Englis',
                'productPictures' => 'Images',
                'subcategory_id' => 'Subcategory',
                'brand_id' => 'Brand',
                'skin_type_id' => 'Skin type',
                'agerange_id' => 'Age range',
                'consumer_id' => 'Consumer',
            ];
        }

        return [
            'code' => 'Код',
            'name' => 'Наименование товара',
            'name_en' => 'Наименование товара по Английски',
            'categoryFile' => 'Изображения',
            'subcategory_id' => 'Подкатегория',
            'brand_id' => 'Бренд',
            'skin_type_id' => 'Тип кожи',
            'agerange_id' => 'Возрастной диапазон',
            'consumer_id' => 'Потребители',
        ];
    }

    public function messages(): array
    {
        if(App::getLocale() === 'en'){

            return [
                'code.regex' => 'The field Code should be written in English letters',
                'name.required' => 'The Наименование товара field is required',
                'name_en.required' => 'The Product name in Englis field is required',
                'name_en.regex' => 'The Product name in Englis field should be written in English letters',
            ];
        }

        return [
            'code.regex' => 'Поле Код должно быть написано латиницей',
            'name.required' => 'Поле Наименование товара обязательно',
            'name_en.required' => 'Поле Product name in Englis обязательно',
            'name_en.regex' => 'Поле Product name in Englis должно быть написано латиницей',
        ];

    }
}
