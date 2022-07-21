<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieGenreTable extends Migration
{
    public function up()
    {
        Schema::create('movie_genre', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('movie_id')->unsigned();
            $table->integer('genre_id')->unsigned();


          //  $table->foreignId('movie_id')->constrained()->onDelete('cascade');
          //  $table->foreignId('genre_id')->constrained()->onDelete('cascade');


        });
    }

    public function down()
    {
        Schema::dropIfExists('movie_genre');
    }
}
