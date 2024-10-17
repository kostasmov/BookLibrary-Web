<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'bookId' => 'required|integer',
            'title' => 'required|string|max:160',
            'publisher' => 'nullable|string|max:50',
            'year' => 'nullable|integer',
            'type' => 'required|string',
            'amount' => 'required|integer|min:0',
            'authors' => 'required|array',
            'authors.*.first_name' => 'required|string|max:30',
            'authors.*.last_name' => 'required|string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Не заполнено название книги',
            'authors.required' => 'Необходимо указать хотя бы одного автора.',
            'authors.*.first_name.required' => 'Имя автора обязательно для заполнения.',
            'authors.*.last_name.required' => 'Фамилия автора обязательна для заполнения.',
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
