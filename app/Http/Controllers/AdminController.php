<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Genre;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Admin;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!User::author()) {
            return redirect('home');
        }

        return view('admin.index',compact('actors','genres'));

    }


    public function sync(Request $request)
    {
        return Admin::syncSingle($request);
    }

    public function showMoviesPanel()
    {

        $stripedMovies = Movie::all()->pluck('imbdId');

        $movies = [];

        foreach ($stripedMovies as $movie) {
            array_push($movies,$movie);
        }



        if(User::editor()) {
            $moviesToEdit = Movie::all();
        } else {
            $moviesToEdit = Movie::where('added_by','=', auth()->id())->get();
        }

        return view('admin.movies',compact('movies','moviesToEdit'));
    }

    public function showUsersPanel()
    {
        $users = User::all();

        return view('admin.users',compact('users'));
    }

    public function showActorsPanel()
    {
        $actors = Actor::all();

        return view('admin.actors',compact('actors'));
    }

    public function showGenresPanel()
    {
        $genres = Genre::all();

        return view('admin.genres',compact('genres'));
    }



}
