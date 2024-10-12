<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'login' => [
                'required',
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
        ]);

        $user->login = $validatedData['login'];
        $user->reader->email = $validatedData['email'];
        $user->reader->phone = $validatedData['phone'];

        $user->push();

        return redirect()->back()->with('update-success', 'Данные профиля успешно обновлены');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'old-pass' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Неверно указан старый пароль');
                }
            }],
            'new-pass' => 'required|string|min:4|max:20',
        ]);

        Auth::user()->update([
            'password' => Hash::make($validatedData['new-pass']),
        ]);

        return redirect()->back()->with('update-success', 'Пароль успешно изменён');
    }
}
