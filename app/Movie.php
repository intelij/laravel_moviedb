<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
use Laravel\Scout\Searchable;

class Movie extends Model
{

    use Searchable;


    protected $fillable = [
        'title',
        'runtime',
        'released',
        'director',
        'plot',
        'poster',
        'country',
        'language',
        'imdbRating',
        'boxOffice',
        'production',
        'rated',
        'awards',
        'website',
        'imbdId',
        'added_by'
    ];

    public function users()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function toSearchableArray()
    {
        /**
         * Load the categories relation so that it's available
         *  in the laravel toArray method
         */

        $this->genres;
        $this->actors;
        $this->ratings;



        return $this->toArray();
    }

    public static function top()
    {
        $top = DB::table('movies')
            ->orderBy('released', 'desc')
            ->take(9)
            ->get();

        return $top;
    }

    public static function recommenderArray()
    {
        $array = [];




        $users = User::all();

        foreach ($users as $user) {
            $inner = [];
            if($user->ratings->count() > 0) {
                $ratings = $user->ratings;
                foreach ($ratings as $rating) {
                    $movie = Movie::find($rating->movie_id)->title;
                    $rate = $rating->rating;
                    $inner[$movie] = $rate;
                }
                $array[$user->name] = $inner;
            }
        }

        return $array;

    }



}
