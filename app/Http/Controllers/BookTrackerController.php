<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookTrackerController extends Controller
{
    public function index(): View
    {
        $issuances = Issuance::where('reader_id', auth()->user()->reader->id)->paginate(10);
        return view('book-tracker', compact('issuances'));
    }
}
