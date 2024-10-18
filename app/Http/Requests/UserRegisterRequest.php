<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }


    public function rules(): array
    {
        return [
            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'login' => 'required|string|unique:users,login|max:20',
            'password' => 'required|string|min:4',
            'group' => 'nullable|regex:/[А-Я]{1,3}\/б\-[0-9]{2}\-[0-9]\-[а-я]{1,2}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'Не заполнено Имя',
            'lastName.required' => 'Не указана Фамилия',
            'login.required' => 'Не заполнен Логин',
            'login.unique' => 'Логин уже используется другим пользователем',
            'password.required' => 'Не заполнен пароль',
            'password.min' => 'Пароль должен содержать минимум 4 символа',
            'group.regex' => 'Неверный формат группы',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Ошибка валидации',
            'error' => $validator->errors()->first(),
        ], 422));
    }
}
