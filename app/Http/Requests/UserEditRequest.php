<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['nullable', 'min:6'],
            'role'=>['required'],
            'status'=>['required'],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'email.required' => 'ایمیل را وارد کنید.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'password.min' => 'زمز عبور حداقل باید 6 کارکتر باشد.',
            'role.required'=>'لطفا حداقل یک نقش را انتخاب کنید',
            'status.required'=>'لطفا یکی از وضعیت ها را انتخاب نمایید'
        ];
    }

}
