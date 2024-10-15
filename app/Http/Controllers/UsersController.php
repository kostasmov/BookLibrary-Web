<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(8);
        return view('users', compact('users'));
    }
}
