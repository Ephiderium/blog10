<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string' => 'Неверный формат заголовка',
            'title.max' => 'Слишком длинный заголовок',
            'content.max' => 'Слишком длинный текст поста',
            'content.string' => 'Неверный формат текста поста',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Текст поста',
        ];
    }
}
