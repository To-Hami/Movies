<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Mixed_;

class Genre extends Model
{
    use HasFactory;

    protected $fillable =['id','e_id','name'];

    // rel
   public  function movies (){
       return $this->belongsToMany(Movie::class,'movie_genre');
   }
}
