<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
            'body' => 'required|string|max:255',
            'category' => 'required|string|max:20',
            'model_id' => 'required|integer',
            'model_type' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'body.required' => 'Текст комментария обязателен',
            'body.string' => 'Неверный формат комментария',
            'body.max' => 'Комментарий слишком длинный',
            'category.required' => 'Категория обязательна',
            'category.string' => 'Неверный формат категории',
            'category.max' => 'Слишком длинный текст категории',
            'model_id.required' => 'Необходим id модели',
            'model_id.integer' => 'Неверный формат id модели',
            'model_type.required' => 'Необходим тип модели',
            'model_type.string' => 'Неверный тип модели',
        ];
    }

    public function attributes(): array
    {
        return [
            'body' => 'Текст комментария',
            'category' => 'Категория',
            'model_id' => 'id модели',
            'model_type' => 'тип модели',
        ];
    }
}
