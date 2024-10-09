<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Issuance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(): View
    {
        $books = Book::paginate(6);

        foreach ($books as $book) {
            $book->status = $this->getBookStatus($book);
        }

        return view('library', compact('books'));
    }

    private function getBookStatus(Book $book): String
    {
        $userIssuances = Issuance::where('book_id', $book->id)
            ->where('reader_id', Auth::user()->reader->id)
            ->where('status', '!=', 'returned')
            ->get();

        if ($userIssuances->isNotEmpty()) {
            if ($userIssuances->where('status', 'issued')->isNotEmpty()) {
                return 'issued';
            }

            return 'pending';
        }

        $issuedCount = Issuance::where('book_id', $book->id)
            ->where('status', 'issued')
            ->count();

        if ($book->amount == 0 || $issuedCount >= $book->amount) {
            return 'not-available';
        }

        return 'available';
    }
}
