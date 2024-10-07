<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(): View
    {
        $books = Book::paginate(6);

        return view('library', compact('books'));
    }
}
