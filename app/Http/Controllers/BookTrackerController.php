<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use Illuminate\View\View;

class BookTrackerController extends Controller
{
    public function index(): View
    {
        $sort = request('sort', 'issue');

        $user = auth()->user();
        $issuances = [];

        if (!empty($user->reader)) {
            $issuancesQuery = Issuance::where('reader_id', $user->reader->id);

            switch ($sort) {
                case 'issue':
                    $issuancesQuery->orderByRaw('book_date IS NULL DESC')
                    ->orderBy('book_date', 'desc');
                    break;
                case 'return':
                    $issuancesQuery->orderByRaw('return_date IS NULL DESC')
                    ->orderBy('return_date', 'desc');
                    break;
                case 'title':
                    $issuancesQuery->join('books', 'issuances.book_id', '=', 'books.id')
                        ->orderBy('books.title', 'asc');
                    break;
                default:
                    $issuancesQuery->orderBy('created_at', 'desc');
                    break;
            }

            $issuances = $issuancesQuery->paginate(8);
        }

        return view('book-tracker', compact('issuances'));
    }
}
