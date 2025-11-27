<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'category' => 'required|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок обязателен',
            'title.string' => 'Неверный формат заголовка',
            'title.max' => 'Слишком длинный заголовок',
            'content.max' => 'Слишком длинный текст поста',
            'content.required' => 'Текст поста обязателен',
            'content.string' => 'Неверный формат текста поста',
            'category.required' => 'Категория обязательна',
            'category.string' => 'Неверный формат категории',
            'category.max' => 'Слишком длинный текст категории',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Текст поста',
            'category' => 'Категория',
        ];
    }
}
