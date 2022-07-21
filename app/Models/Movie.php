<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Movie extends Model
{
    protected $fillable = [

        'e_id',
        'description',
        'title',
        'poster',
        'banner',
        'release_date',
        'vote',
        'vote_Count',
        'type'
    ];
    use HasFactory;

    protected $appends = ['poster_path', 'banner_path'];
    protected $casts = ['release_date' => 'date'];

    //attr
    public function getPosterPathAttribute()
    {
        if($this->poster){
            Return 'https://image.tmdb.org/t/p/w500' . $this->poster;

        }else{
            Return 'https://image.tmdb.org/t/p/w500/7RyL4LVB12umzxMHjiiBcv7vucn.jpg';

        }

    }

//scope

    public function scopeWhenGenreId($query, $genreId)
    {
        return $query->when($genreId, function ($q) use ($genreId) {

            return $q->whereHas('genres', function ($qu) use ($genreId) {

                return $qu->where('genres.id', $genreId);

            });

        });
    }



    public function scopeWhenActorId($query, $actorId)
    {
        return $query->when($actorId, function ($q) use ($actorId) {

            return $q->whereHas('actors', function ($qu) use ($actorId) {

                return $qu->where('actors.id', $actorId);

            });

        });
    }


    public function scopeWhenType($query, $type)
    {
        return $query->when($type, function ($q) use ($type) {

                return $q->where('type', $type);

        });
    }


//attr
    public  function getBannerPathAttribute()
    {
        Return 'https://image.tmdb.org/t/p/w500' . $this->banner;
    }


    //rel

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    public function images (){
        return $this->hasMany(Image::class);
    }


}
