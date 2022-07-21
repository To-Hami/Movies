<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $popularMovies = Movie::where('type', null)
            ->limit(5)
            ->orderBy('vote_Count', 'desc')
            ->get();

        $upcomingMovies = Movie::where('type', 'upcoming')
            ->limit(5)
            ->orderBy('vote_Count', 'desc')
            ->get();

        $now_playingMovies = Movie::where('type', 'now_playing')
            ->limit(5)
            ->orderBy('vote_Count', 'desc')
            ->get();

        return view('admin.home',compact('popularMovies','now_playingMovies','upcomingMovies'));

    }// end of index


    public function topStatistics()
    {
        $genresCount = number_format(Genre::count(), 1);
        $moviesCount = number_format(Movie::count(), 1);
        $actorsCount = number_format(Actor::count(), 1);

        return response()->json([
            'genres_count' => $genresCount,
            'movies_count' => $moviesCount,
            'actors_count' => $actorsCount,
        ]);

    }// end of topStatistics

    public function moviesChart()
    {
        $movies = Movie::whereYear('release_date', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(release_date) as month'),
                DB::raw('YEAR(release_date) as year'),
                DB::raw('COUNT(id) as total_movies'),
            )
            ->groupBy('month')
            ->get();
        return view('admin._movies_chart', compact('movies'));


    }// end of moviesChart

}//end of controller
