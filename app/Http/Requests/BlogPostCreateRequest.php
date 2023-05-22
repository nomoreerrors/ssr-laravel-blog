<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title'  => 'required|min:5|max:200|unique:blog_posts',
            'content_raw' => 'required|string|max:10000|min:3',
            'category_id' => 'required|integer|exists:blog_categories,id',
            'is_published' => 'boolean'
        ];
    }



    /**
     * Translate messages
     */
    public function messages()
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно',
            'title.min' => 'Введите не менее :min символов в заголовок',
            'title.max' => 'Поле "Заголовок" не должно превышать :max символов',
            'title.unique' => 'Такое название уже существует',
            'content_raw.required' => 'Заполните описание',
        ];
    }
}
