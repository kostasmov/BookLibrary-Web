<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $books = Book::paginate(8);

        foreach ($books as $book) {
            $book->issuances = $this->countIssuedBooks($book->id);
        }

        return view('catalog', compact('books'));
    }

    private function countIssuedBooks(Int $bookId): int
    {
        return DB::table('issuances')
            ->where('book_id', $bookId)
            ->where('status', 'issued')
            ->count();
    }

    public function getBook(Request $request): JsonResponse
    {
        $bookId = $request->input('id');

        $book = Book::find($bookId);
        if ($book) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $book->id,
                    'title' => $book->title,
                    'publisher' => $book->publisher,
                    'book_year' => $book->book_year,
                    'amount' => $book->amount,
                    'type' => $book->type,
                    'authors' => $book->authors,
                    'issuances' => $this->countIssuedBooks($book->id)
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Книга не найдена'
            ], 404);
        }
    }

    public function createBook(BookRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $book = new Book();
            $book->title = $validatedData['title'];
            $book->publisher = $validatedData['publisher'];
            $book->book_year = $validatedData['year'];
            $book->type = $validatedData['type'];
            $book->amount = $validatedData['amount'];
            $book->save();

            $authorIds = [];

            foreach ($validatedData['authors'] as $authorData) {
                $author = Author::firstOrCreate([
                    'first_name' => $authorData['first_name'],
                    'last_name' => $authorData['last_name']
                ]);

                $authorIds[] = $author->id;
            }

            $book->authors()->sync($authorIds);

            DB::commit();

            return response()->json([
                'message' => 'Книга успешно создана',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Произошла ошибка при создании книги',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function editBook(Request $request): JsonResponse
    {
        return response()->json(['message' => 'Fetch работает (edit)',]);
    }
}
