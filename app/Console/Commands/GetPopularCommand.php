<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetPopularCommand extends Command
{
    protected $signature = 'get:populars';

    protected $description = ' get all populars movies';

    public function handle()
    {
         $this->getPopulars();
         $this->getUpcoming();
         $this->getNowPlaying();
    }

    //get populars movies
    private function getPopulars()
    {

        for ($i = 1; $i <= config('services.tmdb.page'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') .
                '/movie/popular?region=us&api_key=' . config('services.tmdb.api_key') . '&page=' . $i);
            foreach ($response->json()['results'] as $result) {

                $movie = Movie::where(['e_id' => $result['id']])->first();


                $movie = Movie::updateOrCreate([


                    'e_id' => $result['id'],
                    'title' => $result['title'],

                ],
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_Count' => $result['vote_count'],
                    ]);


                $this->attachOrSyncActor($movie);
                $this->syncGenre($movie, $result);
                $this->getImagesMovie($movie);

            }


        }


    }// end of get populars movies


    //get populars movies
    private function getUpcoming()
    {

        for ($i = 1; $i <= config('services.tmdb.page'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') .
                '/movie/upcoming?region=us&api_key=' . config('services.tmdb.api_key') . '&page=' . $i);
            foreach ($response->json()['results'] as $result) {
                $movie = Movie::where(['e_id' => $result['id']])->first();


                $movie = Movie::updateOrCreate([


                    'e_id' => $result['id'],
                    'title' => $result['title'],

                ],
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'upcoming',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_Count' => $result['vote_count'],
                    ]);


                $this->attachOrSyncActor($movie);
                $this->syncGenre($movie, $result);
                $this->getImagesMovie($movie);

            }


        }


    }// end of get upcoming movies //get populars movies


    //get now_playing movies
    private function getNowPlaying()
    {

        for ($i = 1; $i <= config('services.tmdb.page'); $i++) {

            $response = Http::get(config('services.tmdb.base_url') .
                '/movie/now_playing?region=us&api_key=' . config('services.tmdb.api_key') . '&page=' . $i);
            foreach ($response->json()['results'] as $result) {
                $movie = Movie::where(['e_id' => $result['id']])->first();


                $movie = Movie::updateOrCreate([


                    'e_id' => $result['id'],
                    'title' => $result['title'],

                ],
                    [
                        'e_id' => $result['id'],
                        'title' => $result['title'],
                        'description' => $result['overview'],
                        'poster' => $result['poster_path'],
                        'banner' => $result['backdrop_path'],
                        'type' => 'now_playing',
                        'release_date' => $result['release_date'],
                        'vote' => $result['vote_average'],
                        'vote_Count' => $result['vote_count'],
                    ]);


                $this->attachOrSyncActor($movie);
                $this->syncGenre($movie, $result);
                $this->getImagesMovie($movie);

            }


        }


    }// end of get now_playing movies


    // attache images to movie
    private function getImagesMovie(Movie $movie)
    {

        $response = Http::get(config('services.tmdb.base_url') .
            '/movie/' . $movie->e_id . '/images?&api_key=' . config('services.tmdb.api_key'));
        foreach ($response->json()['backdrops'] as $index => $images) {
            if($index == 12) break;
            $movie->images()->create([
                'image' => $images['file_path']
            ]);

        }


    }     // end of attache images to movie

 //attach Genre to movie
//    private function attachGenre(Movie $movie, $result)
//    {
//        foreach ($result['genre_ids'] as $genreId) {
//
//            $genre = Genre::where('e_id', $genreId)->first();
//            $movie->genres()->attach($genre->id);
//
//        }
//    }


    //sync Genre to movie
    private function syncGenre(Movie $movie, $result)
    {
        foreach ($result['genre_ids'] as $genreId) {

            $genre = Genre::where('e_id', $genreId)->first();
            $movie->genres()->syncWithoutDetaching($genre->id);

        }
    }    // end of sync Genre to movie


    //attach or sync Actor to movie
    private function attachOrSyncActor(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url') .
            '/movie/' . $movie->e_id . '/credits?api_key=' . config('services.tmdb.api_key'));

        foreach ($response->json()['cast'] as $index => $cast) {

            if ($cast['known_for_department'] != 'Acting') continue;

            if ($index == 12) break;

            $actor = Actor::where(['e_id' => $cast['id']])->first();

            if (!$actor) {
                $actor = Actor::create([
                    'e_id' => $cast['id'],
                    'name' => $cast['name'],
                    'image' => $cast['profile_path']

                ]);

                $movie->actors()->syncWithoutDetaching($actor->id);

            }
        }

    }    // end attach or sync Actor to movie


}
