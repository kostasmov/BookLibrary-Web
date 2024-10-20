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
        $sort = request('sort');
        $search = request('search');

        $books = Book::query();

        if ($search) {
            $books->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('publisher', 'LIKE', "%{$search}%")
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->where('first_name', 'LIKE', "%{$search}%")
                            ->orWhere('last_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        switch ($sort) {
            case 'title':
                $books->orderBy('title');
                break;
            case 'year':
                $books->orderBy('book_year', 'desc');
                break;
            default:
                $books->orderBy('created_at', 'desc');
                break;
        }

        $books = $books->paginate(6);

        foreach ($books as $book) {
            $book->status = $this->getBookStatus($book);
        }

        return view('library', compact('books'));
    }

    private function getBookStatus(Book $book): string
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

    public function makeRequest($bookId): RedirectResponse
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

    // Доп страница с информацией о библиотеке и картой
    public function about(): View
    {
        return view('about-library');
    }
}
