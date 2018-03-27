<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('movie_wishlist', function (Blueprint $table) {
            $table->integer('movie_id');
            $table->integer('wishlist_id');
            $table->primary(['movie_id','wishlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('movie_wishlist');
    }
}
