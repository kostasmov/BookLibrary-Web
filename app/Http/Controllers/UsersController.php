<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Issuance;
use App\Models\Reader;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(8);
        return view('users', compact('users'));
    }

    public function createUser(UserRegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $reader = Reader::create([
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'group_code' => $validated['group'],
            ]);

            $user = User::create([
                'login' => $validated['login'],
                'password' => Hash::make($validated['password']),
                'reader_id' => $reader->id,
            ]);

            $reader->update(['user_id' => $user->id]);

            DB::commit();

            return response()->json(['message' => 'Пользователь успешно зарегистрирован']);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Ошибка при регистрации пользователя',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function editUser(UserEditRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            $user = User::findOrFail($validated['userId']);

            if (!$user) {
                throw new Exception('Пользователь не найден');
            }

            $user->login = $validated['login'];
            $user->reader->first_name = $validated['firstName'];
            $user->reader->last_name = $validated['lastName'];
            $user->reader->group_code = $validated['group'];

            $user->save();
            $user->reader->save();

            DB::commit();

            return response()->json([
                'message' => 'Пользователь успешно обновлён',
                'user' => $user,
                'reader' => $user->reader,
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Не удалось обновить данные пользователя',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function deleteUser($id): JsonResponse
    {
        $currentUserId = auth()->id();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Пользователь не найден'], 400);
        }

        if ($currentUserId == $id) {
            return response()->json(['message' => 'Невозможно удалить самого себя'], 400);
        }

        $isMentioned = Issuance::where('reader_id', $user->reader->id)
            ->where('status', '!=', 'pending')
            ->exists();

        if ($isMentioned) {
            return response()->json(['message' => 'Невозможно удалить пользователя - он числится в выдачах'], 400);
        }

        DB::transaction(function () use ($user) {
            if ($user->reader) {
                $user->reader->delete();
            }

            $user->delete();
        });

        return response()->json(['message' => 'Пользователь успешно удалён']);
    }
}
