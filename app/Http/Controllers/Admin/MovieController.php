<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_movies')->only(['index']);
        $this->middleware('permission:create_movies')->only(['create', 'store']);
        $this->middleware('permission:update_movies')->only(['edit', 'update']);
        $this->middleware('permission:delete_movies')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        $actor = null;
        if (request()->actor_id) {
            $actor = Actor::FindOrFail(request()->actor_id);

        }
        $genres = Genre::all();
        $actors = null;
        return view('admin.movies.index', compact('genres', 'actor'));
    }// end of index

    public function data()
    {
        $actor = null;
        $movies = Movie::WhenGenreId(request()->genre_id)
            ->WhenActorid(request()->actor_id)
            ->WhenType(request()->type)
            ->with('genres')->select();

        return DataTables::of($movies)
            ->addColumn('record_select', 'admin.movies.data_table.record_select')
            ->addColumn('poster', function (Movie $movie) {
                return view('admin.movies.data_table.image', compact('movie'));
            })
            ->addColumn('genres', function (Movie $movie) {
                return view('admin.movies.data_table.genres', compact('movie'));
            })
            ->addColumn('release_date', function (Movie $movie) {
                return $movie->release_date->format('D-M-Ym');
            })
            ->editColumn('vote_Count', 'admin.movies.data_table.vote_Count')
            ->addColumn('actions', 'admin.movies.data_table.actions')
            ->rawColumns(['record_select', 'actions', 'vote_Count'])
            ->toJson();

    }// end of data

    public  function show($id){
        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));

    }

    public function destroy(Movie $movie)
    {
        $this->delete($movie);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $movie = Movie::FindOrFail($recordId);
            $this->delete($movie);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Movie $movie)
    {
        $movie->delete();

    }// end of delete
}
