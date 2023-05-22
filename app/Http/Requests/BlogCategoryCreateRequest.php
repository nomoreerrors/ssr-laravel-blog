<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'  => 'required|min:5|max:200|unique:blog_categories',
            'slug'  => 'max:200',
            'description' => 'string|max:1000|min:3',
            'parent_id' => 'integer|exists:blog_categories,id',
    ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Поле "Title" обязательно',
            'title.min' => 'Введите не менее :min символов',
            'title.max' => 'Поле "Title" не должно превышать :max символов',
            'title.unique' => 'Такое название уже существует',
            'content_raw.required' => 'Заполните описание',
        ];
    }
}
