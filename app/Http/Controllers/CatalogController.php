<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
}
