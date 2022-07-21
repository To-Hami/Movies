<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{

    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('e_id');
            $table->text('description');
            $table->string('title');
            $table->string('poster')->nullable();
            $table->string('banner')->nullable();
            $table->enum('type',['upcoming','now_playing'])->nullable();
            $table->date('release_date');
            $table->double('vote',8,2);
            $table->integer('vote_Count');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
