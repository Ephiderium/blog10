<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно',
            'name.string' => 'Введите строку',
            'name.max' => 'Слишком длинное имя',
            'email.required' => 'Электронная почта обязательна',
            'email.email' => 'Неверный формат почты',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль слишком короткий',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
        ];
    }
}
