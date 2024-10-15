<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use Illuminate\View\View;

class BookTrackerController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $issuances = [];

        if (!empty($user->reader)) {
            $issuances = Issuance::where('reader_id', $user->reader->id)->paginate(8);
        }

        return view('book-tracker', compact('issuances'));
    }
}
