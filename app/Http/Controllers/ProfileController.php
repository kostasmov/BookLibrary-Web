<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile');
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'Нет аккаунта');
        }

        $validatedData = $request->validated();

        $user->login = $validatedData['login'];
        $user->reader->email = $validatedData['email'];
        $user->reader->phone = $validatedData['phone'];

        $user->push();

        return redirect()->back()->with('update-success', 'Данные профиля успешно обновлены');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'Нет аккаунта');
        }

        $validatedData = $request->validate([
            'old-pass' => ['required', function ($attribute, $value, $fail) {
                global $user;
                if (!Hash::check($value, $user->password)) {
                    $fail('Неверно указан старый пароль');
                }
            }],
            'new-pass' => 'required|string|min:4|max:20',
        ]);

        $user->update([
            'password' => Hash::make($validatedData['new-pass']),
        ]);

        return redirect()->back()->with('update-success', 'Пароль успешно изменён');
    }
}
