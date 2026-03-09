<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user() || !Auth::user()->isAdmin()) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'moviesCount' => Movie::count(),
            'usersCount' => User::count(),
        ]);
    }

    public function movies()
    {
        $movies = Movie::latest()->paginate(20);

        return view('admin.movies.index', compact('movies'));
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'release_year' => ['nullable', 'integer'],
        ]);

        $data['created_by'] = Auth::id();

        Movie::create($data);

        return redirect()->route('admin.movies.index')
            ->with('status', 'Фильм успешно добавлен');
    }
}


