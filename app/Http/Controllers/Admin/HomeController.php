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

        return view('admin.home');
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
