<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
}
