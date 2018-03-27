<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Recommend;
use App\User;
use App\Genre;
use App\Actor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use App\Http\Requests\AddMovieRequest;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','2fa'])->except('show');
    }

    public function index()
    {

    }

    public function create()
    {
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movie.create',compact('actors','genres'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        $wls = "";

        if(auth()->check())
        {
            $user = User::find(auth()->id());

            $wls = $user->wishlists;

        }

        $rating = 0;

        foreach ($movie->ratings as $ratings) {
            $rating += $ratings->rating;
        }

        if(!$rating == 0) {
            $rating = $rating/$movie->ratings->count();
        }

        if(auth()->check()) {
            if(!session()->has('recent')) {

                session(['recent.movies' => [$movie->id]]);
                session()->push('recent.id', auth()->id());
                session()->save();

            } elseif (!in_array($movie->id,session('recent.movies'),true) && session('recent.id')[0] == auth()->id()) {

                session()->push('recent.movies', $movie->id);
                session()->save();

            } elseif (session('recent.id')[0] != auth()->id()) {

                session()->regenerate(true);
                session(['recent.movies' => [$movie->id]]);
                session()->push('recent.id', auth()->id());
                session()->save();

            }
        } else {
            session()->regenerate(true);
        }

        return view('movie.show',compact('movie','rating','wls'));
    }

    public function edit($id) {
        $movie = Movie::findOrFail($id);

        $currentActors = $movie->actors;

        $currentGenres = $movie->genres;

        $actors = Actor::all();
        $genres = Genre::all();


        if(!User::author()) {
            return redirect('home');
        }

        if(!User::editor()) {
            if($movie->added_by != auth()->id()) {
                return redirect('admin');
            }
        }

        return view('movie.edit',compact('movie','currentActors','currentGenres','actors','genres'));
    }

    public function update(Request $request,$movie_id) {

        $request->validate([
            'title' => 'required',
            'runtime' => 'required',
            'released' => 'required',
            'director' => 'required',
            'plot' => 'required',
            'poster' => 'required',
            'country' => 'required',
            'language' => 'required',
            'imdbRating' => 'required',
            'boxOffice' => 'required',
            'production' => 'required',
            'rated' => 'required',
            'awards' => 'required',
            'website' => 'required',
            'imbdId' => 'required',
        ]);


        try {
            DB::table('movies')
                ->where('id','=',$movie_id)
                ->update([
                    'title' => $request->input('title'),
                    'rated' => $request->input('rated'),
                    'runtime' => $request->input('runtime'),
                    'released' => $request->input('released'),
                    'director' => $request->input('director'),
                    'plot' => $request->input('plot'),
                    'language' => $request->input('language'),
                    'country' => $request->input('country'),
                    'poster' => $request->input('poster'),
                    'awards' => $request->input('awards'),
                    'imdbRating' => $request->input('imdbRating'),
                    'imbdId' => $request->input('imbdId'),
                    'boxOffice' => $request->input('boxOffice'),
                    'production' => $request->input('production'),
                    'website' => $request->input('website'),
                    'added_by' => auth()->id()
                ]);

            if(empty($request->input('current_actors'))) {
                Movie::findOrFail($movie_id)->actors()->detach();
            } else {
                Movie::findOrFail($movie_id)->actors()->detach();
                Movie::findOrFail($movie_id)->actors()->attach($request->input('current_actors'));
            }

            if(empty($request->input('current_genres'))) {
                Movie::findOrFail($movie_id)->genres()->detach();
            } else {
                Movie::findOrFail($movie_id)->genres()->detach();
                Movie::findOrFail($movie_id)->genres()->attach($request->input('current_genres'));
            }

            session()->flash('message','Move has been updated');

            return redirect('admin');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function store(AddMovieRequest $request)
    {
        $actors = [];
        $genres = [];

        if($request->has('actors')) {
            $actors = $request->input('actors');
        }

        if($request->has('genres')) {
            $genres = $request->input('genres');
        }

       $movie = DB::table('movies')
           ->insertGetId([
               'title' => $request->input('title'),
               'rated' => $request->input('rated'),
               'runtime' => $request->input('runtime'),
               'released' => $request->input('released'),
               'director' => $request->input('director'),
               'plot' => $request->input('plot'),
               'language' => $request->input('language'),
               'country' => $request->input('country'),
               'poster' => $request->input('poster'),
               'awards' => $request->input('awards'),
               'imdbRating' => $request->input('imdbRating'),
               'imbdId' => $request->input('imbdId'),
               'boxOffice' => $request->input('boxOffice'),
               'production' => $request->input('production'),
               'website' => $request->input('website'),
               'added_by' => auth()->id()
           ]);

        if(count($actors) > 0) {
            foreach ($actors as $actor) {
                Movie::find($movie)->actors()->attach($actor);
            }
        }

        if(count($genres) > 0) {
            foreach ($genres as $genre) {
                Movie::find($movie)->genres()->attach($genre);
            }
        }

        session()->flash('message','Movie Created Successfully.');

        return redirect('admin');
    }

    public function destroy(Request $request,$dd)
    {
        $id = $request->input('movieToDelete');
        $movie = Movie::findOrFail($id);
        $movie->actors()->detach();
        $movie->genres()->detach();
        $movie->delete();

        session()->flash('Movie has been deleted.');

        return redirect('admin');
    }
}
