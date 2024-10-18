<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UserRegisterRequest;
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

    public function editUser(BookRequest $request): JsonResponse
    {
//        DB::beginTransaction();
//
//        try {
//            $validatedData = $request->validated();
//
//            $book = Book::findOrFail($validatedData['bookId']);
//
//            if (!$book) {
//                throw new Exception('Книга не найдена');
//            }
//
//            $book->title = $validatedData['title'];
//            $book->publisher = $validatedData['publisher'];
//            $book->book_year = $validatedData['year'];
//            $book->type = $validatedData['type'];
//            $book->amount = $validatedData['amount'];
//
//            $authorIds = [];
//
//            foreach ($validatedData['authors'] as $authorData) {
//                $author = Author::firstOrCreate([
//                    'first_name' => $authorData['first_name'],
//                    'last_name' => $authorData['last_name']
//                ]);
//
//                $authorIds[] = $author->id;
//            }
//
//            $book->authors()->sync($authorIds);
//
//            $book->save();
//
//            DB::commit();
//
//            return response()->json([
//                    'message' => 'Книга успешно обновлена',
//                    'book' => $book]
//            );
//        } catch (Exception $e) {
//            DB::rollBack();
//
//            return response()->json([
//                'message' => 'Не удалось обновить книгу',
//                'error' => $e->getMessage()
//            ], 400);
//        }
    }

    public function deleteUser($id): JsonResponse
    {
//        $book = Book::find($id);
//
//        if (!$book) {
//            return response()->json(['message' => 'Книга не найдена'], 400);
//        }
//
//        $isIssued = Issuance::where('book_id', $id)
//            ->where('status', '!=', 'pending')
//            ->exists();
//
//        if ($isIssued) {
//            return response()->json(['message' => 'Невозможно удалить книгу - она числится в выдачах'], 400);
//        }
//
//        $book->delete();
//
//        return response()->json(['message' => 'Книга успешно удалена']);
    }
}
