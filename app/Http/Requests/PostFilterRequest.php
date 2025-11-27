<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFilterRequest extends FormRequest
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
            'sort' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'word' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'sort.string' => 'Неверный тип сортировки',
            'category.string' => 'Неверный тип категории',
            'word.string' => 'Неверный тип запроса',
        ];
    }

    public function attributes(): array
    {
        return [
            'sort' => 'Сортировка',
            'category' => 'Категория',
            'word' => 'Слово',
        ];
    }
}
