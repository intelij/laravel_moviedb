<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Genre;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class Admin extends Model
{
    public static function syncSingle($request)
    {
        try {
            $title = addslashes($request->Title);
            $rated = $request->Rated;
            $released = $request->Released;
            if ($released != 'N/A') {
                $released = Carbon::createFromFormat('j M Y', $request->Released)->format('Y-m-d');
            } else {
                $released = Carbon::createFromFormat('j M Y', '1 Jan 1000')->format('Y-m-d');
            }
            $runtime = $request->Runtime;
            if ($runtime != "N/A") {
                $runtime = explode(' ', $request->Runtime)[0];
            } else {
                $runtime = 0;
            }
            $genres = explode(', ', $request->Genre);
            $director = $request->Director;
            $actors = explode(', ', $request->Actors);
            $plot = $request->Plot;
            $language = $request->Language;
            $country = $request->Country;
            $poster = $request->Poster;
            $awards = $request->Awards;
            $imdbRating = $request->imdbRating;
            if ($imdbRating == "N/A") {
                $imdbRating = 0.0;
            }
            $imdbId = $request->imdbID;
            $boxOffice = $request->BoxOffice;
            if ($boxOffice != "N/A") {
                $boxOffice = explode(',', $request->BoxOffice);
                $boxOffice[0] = explode('$', $boxOffice[0])[1];
                $boxOffice = implode($boxOffice);
            } else {
                $boxOffice = 0;
            }
            $production = $request->Production;
            $website = $request->Website;
        } catch (Exception $e) {
            return $e;
        }

        $record = DB::table('movies')->where('title', '=', $title)->get()->count();

        if ($record > 0) {
            DB::table('movies')
                ->where('title', '=', $title)
                ->update([
                    'rated' => $rated,
                    'runtime' => $runtime,
                    'released' => $released,
                    'director' => $director,
                    'plot' => $plot,
                    'language' => $language,
                    'country' => $country,
                    'poster' => $poster,
                    'awards' => $awards,
                    'imdbRating' => $imdbRating,
                    'imbdId' => $imdbId,
                    'boxOffice' => $boxOffice,
                    'production' => $production,
                    'website' => $website,
                    'added_by' => auth()->id()
                ]);

            try {
                foreach ($actors as $actor) {
                    if (DB::table('actors')->where('name', '=', $actor)->doesntExist()) {
                        DB::table('actors')
                            ->insert([
                                'name' => $actor
                            ]);
                    }

                    if (DB::table('actor_movie')->where([
                        ['actor_id','=',DB::table('actors')->where('name', '=', $actor)->first()->id],
                        ['movie_id','=',DB::table('movies')->where('title', '=', $title)->first()->id]
                    ])->doesntExist()) {
                        Movie::where('title', '=', $title)
                            ->first()
                            ->actors()
                            ->attach(DB::table('actors')->where('name', '=', $actor)->first()->id);
                    }
                }


                foreach ($genres as $genre) {
                    if (DB::table('genres')->where('name', '=', $genre)->doesntExist()) {
                        DB::table('genres')
                            ->insert([
                                'name' => $genre
                            ]);
                    }

                    if (DB::table('genre_movie')->where([
                        ['genre_id','=',DB::table('genres')->where('name', '=', $genre)->first()->id],
                        ['movie_id','=',DB::table('movies')->where('title', '=', $title)->first()->id]
                    ])->doesntExist()) {
                        Movie::where('title', '=', $title)
                            ->first()
                            ->genres()
                            ->attach(DB::table('genres')->where('name', '=', $genre)->first()->id);
                    }
                }
            } catch (Exception $e) {
                return $e;
            }

        } else {

            DB::table('movies')
                ->insert([
                    'title' => $title,
                    'rated' => $rated,
                    'runtime' => $runtime,
                    'released' => $released,
                    'director' => $director,
                    'plot' => $plot,
                    'language' => $language,
                    'country' => $country,
                    'poster' => $poster,
                    'awards' => $awards,
                    'imdbRating' => $imdbRating,
                    'imbdId' => $imdbId,
                    'boxOffice' => $boxOffice,
                    'production' => $production,
                    'website' => $website,
                    'added_by' => auth()->id()
                ]);

            try {
                foreach ($actors as $actor) {
                    if (DB::table('actors')->where('name', '=', $actor)->doesntExist()) {
                        DB::table('actors')
                            ->insert([
                                'name' => $actor
                            ]);
                    }

                    if (DB::table('actor_movie')->where([
                        ['actor_id','=',DB::table('actors')->where('name', '=', $actor)->first()->id],
                        ['movie_id','=',DB::table('movies')->where('title', '=', $title)->first()->id]
                    ])->doesntExist()) {
                        Movie::where('title', '=', $title)
                            ->first()
                            ->actors()
                            ->attach(DB::table('actors')->where('name', '=', $actor)->first()->id);
                    }
                }


                foreach ($genres as $genre) {
                    if (DB::table('genres')->where('name', '=', $genre)->doesntExist()) {
                        DB::table('genres')
                            ->insert([
                                'name' => $genre
                            ]);
                    }

                    if (DB::table('genre_movie')->where([
                        ['genre_id','=',DB::table('genres')->where('name', '=', $genre)->first()->id],
                        ['movie_id','=',DB::table('movies')->where('title', '=', $title)->first()->id]
                    ])->doesntExist()) {
                        Movie::where('title', '=', $title)
                            ->first()
                            ->genres()
                            ->attach(DB::table('genres')->where('name', '=', $genre)->first()->id);
                    }
                }
            } catch (Exception $e) {
                return $e;
            }
        }


    }
}
