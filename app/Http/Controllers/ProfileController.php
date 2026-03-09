<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['favoriteMovies', 'likedMovies']);

        return view('profile.index', [
            'user' => $user,
        ]);
    }
}


