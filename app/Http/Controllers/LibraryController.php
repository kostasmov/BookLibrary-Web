<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Issuance;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
        $user = Auth::user();
        if (!$user instanceof User) {
            return '';
        }

        $userIssuances = Issuance::where('book_id', $book->id)
            ->where('reader_id', $user->reader->id)
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

    public function makeRequest($bookId):  RedirectResponse
    {
        $book = Book::findOrFail($bookId);
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->back()->with('error', 'Нет аккаунта');
        }

        $hasIssuedBooks = Issuance::where('reader_id', $user->reader->id)
            ->where('status', 'issued')
            ->exists();

        if ($hasIssuedBooks) {
            return redirect()->back()->withErrors('Невозможно подать заявку: имеются невозвращённые книги.');
        }

        $pendingRequestsCount = Issuance::where('reader_id', $user->reader->id)
            ->where('status', 'pending')
            ->count();

        if ($pendingRequestsCount >= 3) {
            return redirect()->back()->withErrors('Число заявок превышает 3!');
        }

        Issuance::create([
            'reader_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return redirect()->route('tracker')->with('success', 'Заявка отправлена!');
    }
}
