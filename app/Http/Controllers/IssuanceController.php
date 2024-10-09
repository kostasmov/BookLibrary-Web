<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IssuanceController extends Controller
{
    public function index(): View
    {
        $issuances = Issuance::paginate(8);
        return view('issuances', compact('issuances'));
    }
}
