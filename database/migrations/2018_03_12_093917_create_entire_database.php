<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEntireDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('added_by')->nullable();
        });

        //role_user table
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unique();
            $table->integer('role_id');
            $table->primary(['user_id','role_id']);
        });

        //movies table
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('runtime')->nullable();
            $table->date('released')->nullable();
            $table->string('director')->nullable();
            $table->text('plot')->nullable();
            $table->string('poster')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->decimal('imdbRating')->nullable();
            $table->integer('boxOffice')->nullable();
            $table->string('production')->nullable();
            $table->string('rated')->nullable();
            $table->string('awards')->nullable();
            $table->string('website')->nullable();
            $table->string('imbdId')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('added_by')->nullable();
        });

        //actors table
        Schema::create('actors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        //actor_movie table
        Schema::create('actor_movie', function (Blueprint $table) {
            $table->integer('actor_id');
            $table->integer('movie_id');
            $table->primary(['actor_id','movie_id']);
        });

        //genres table
        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        //genre_movie table
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->integer('genres_id');
            $table->integer('movies_id');
            $table->primary(['genres_id','movies_id']);
        });

        //ratings table
        Schema::create('ratings', function (Blueprint $table) {
            $table->integer('rating');
            $table->integer('user_id');
            $table->integer('movie_id');
            $table->timestamps();
            $table->primary(['user_id','movie_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('actors');
        Schema::dropIfExists('actor_movie');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('genre_movie');
        Schema::dropIfExists('ratings');

    }
}
