<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetGenresCommand extends Command
{
    protected $signature = 'get:genres';

    protected $description = ' get all genres';

    public function handle()
    {
        $response = Http::get(config('services.tmdb.base_url').'/genre/movie/list?api_key='.config('services.tmdb.api_key'));

          foreach ($response->json()['genres'] as $genre){
               Genre::updateOrCreate([

                   'e_id'=>$genre['id'],
               ],[
                   'name'=>$genre['name'],
               ]);
          }
    }
}
