<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
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
            'likeable_id' => 'required|integer|max:255',
            'likeable_type' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.integer' => 'Неверный тип id пользователя',
            'user_id.required' => 'Не передан id пользователя',
            'likeable_id.integer' => 'Неверный тип id объекта',
            'likeable_id.required' => 'Не передан id модели',
            'likeable_type.string' => 'Неверный тип объекта',
            'likeable_type.required' => 'Не передана модель',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Пользователь, что лайкает',
            'likeable_id' => 'id того, что лайкают',
            'wlikeable_typeord' => 'Тип того, что лайкают',
        ];
    }
}
