<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query()->with('genres');

        // Поиск
        if ($search = $request->get('q')) {
            $query->search($search);
        }

        // Фильтрация по году
        if ($year = $request->get('year')) {
            $query->ofYear($year);
        }

        // Фильтр по жанру
        if ($genreId = $request->get('genre')) {
            $query->ofGenre($genreId);
        }

        // Сортировка
        switch ($request->get('sort')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'rating':
                $query->topRated();
                break;
            case 'popular':
                $query->popular();
                break;
            case 'year':
                $query->latestYear();
                break;
            default:
                $query->newest();
        }

        $movies = $query->paginate(12)->withQueryString();
        $genres = Genre::orderBy('name')->get();

        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres,
        ]);
    }

    public function show(Movie $movie)
    {
        $movie->load(['genres', 'activeComments.user']);

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }

    public function toggleLike(Movie $movie)
    {
        $user = Auth::user();

        if ($user->hasLiked($movie)) {
            $movie->removeLike($user);
        } else {
            $movie->addLike($user);
        }

        return back();
    }

    public function toggleFavorite(Movie $movie)
    {
        $user = Auth::user();

        if ($user->hasFavorited($movie)) {
            $user->favorites()->where('movie_id', $movie->id)->delete();
        } else {
            $user->favorites()->create(['movie_id' => $movie->id]);
        }

        return back();
    }
}


