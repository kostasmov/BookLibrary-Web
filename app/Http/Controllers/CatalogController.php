<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Issuance;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $sort = request('sort', 'title');
        $search = request('search');
        $books = Book::query();

        if ($search) {
            $books->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('book_year', 'LIKE', "%$search%")
                    ->orWhere('publisher', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%")
                    ->orWhereHas('authors', function ($authorQuery) use ($search) {
                        $authorQuery->where('first_name', 'LIKE', "%$search%")
                            ->orWhere('last_name', 'LIKE', "%$search%");
                    });
            });
        }

        switch ($sort) {
            case 'title':
                $books->orderBy('title');
                break;
            case 'publisher':
                $books->orderBy('publisher');
                break;
            default:
                $books->orderBy('created_at', 'desc');
                break;
        }

        $books = $books->paginate(8);

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

    public function editBook(BookRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validated();

            $book = Book::findOrFail($validatedData['bookId']);

            if (!$book) {
                throw new Exception('Книга не найдена');
            }

            $book->title = $validatedData['title'];
            $book->publisher = $validatedData['publisher'];
            $book->book_year = $validatedData['year'];
            $book->type = $validatedData['type'];
            $book->amount = $validatedData['amount'];

            $authorIds = [];

            foreach ($validatedData['authors'] as $authorData) {
                $author = Author::firstOrCreate([
                    'first_name' => $authorData['first_name'],
                    'last_name' => $authorData['last_name']
                ]);

                $authorIds[] = $author->id;
            }

            $book->authors()->sync($authorIds);

            $book->save();

            DB::commit();

            return response()->json([
                'message' => 'Книга успешно обновлена',
                'book' => $book]
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Не удалось обновить книгу',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function deleteBook($id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Книга не найдена'], 400);
        }

        $isIssued = Issuance::where('book_id', $id)
            ->where('status', '!=', 'pending')
            ->exists();

        if ($isIssued) {
            return response()->json(['message' => 'Невозможно удалить книгу - она числится в выдачах'], 400);
        }

        $book->delete();

        return response()->json(['message' => 'Книга успешно удалена']);
    }
}
