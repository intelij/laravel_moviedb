<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('movies') as $movie)
        {
            DB::table('movies')->insert([
                'title' => $movie['title'],
                'imbdId' => $movie['imdbId'],
                'released' => substr($movie['releaseDate'],0,10),
                'country' => $movie['releaseCountry']
            ]);
        }
    }
}
