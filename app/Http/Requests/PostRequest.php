<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $postId = $this->route('id');
        $slug = $this->input('slug') ?: $this->input('title');
        $slug = make_slug($slug); // همین نسخه‌ای که ذخیره میشه، باید چک بشه

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                Rule::unique('posts', 'slug')->ignore($postId)->where(fn($query) => $query->where('slug', $slug)),
            ],
            'description' => ['required', 'string'],
            'category_id'=>['required'],
            'photo_id' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'title.string' => 'فرمت عنوان باید از نوع رشته باشد',
            'slug.unique' => 'لطفا نام مستعار را تغییر این نام در جدول است',
            'description.required' => 'توضیحان ذا واذد کنید',
            'description.string' => 'فرمت توضیحات باید از نوع رشته باشد',
            'category_id.required'=>'لطفا حداقل یک دسته را انتخاب کنید',
            'photo_id.required'=>'لطفا یک عکس را انتخاب نمایید'
        ];
    }
}
