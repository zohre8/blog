<?php

namespace App\Http\Requests;

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
        return [
            'name'=> ['required', 'string', 'max:255'],
            'slug'=>['required', 'string', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'name.string' => 'فرمت نام معتبر نیست، باید از نوع رشته باشد',
            'slug.required' => 'وارد کردن نام الزامی است.',
            'slug.max' => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.string' => 'فرمت اسلاگ معتبر نیست، باید از نوع رشته باشد',

        ];
    }
}
