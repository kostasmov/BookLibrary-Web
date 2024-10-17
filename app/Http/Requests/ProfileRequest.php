<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $user = $this->user();

        return [
            'login' => [
                'string',
                'max:20',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('readers', 'email')->ignore($user->reader->id),
            ],
            'phone' => [
                'nullable',
                'regex:/^\+[0-9]{11}$/',
                Rule::unique('readers', 'phone')->ignore($user->reader->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'login.unique' => 'Этот логин уже занят',
            'email.unique' => 'Этот email уже занят',
            'phone.regex' => 'Неверный формат номера телефона',
            'phone.unique' => 'Этот номер телефона уже занят',
        ];
    }
}
