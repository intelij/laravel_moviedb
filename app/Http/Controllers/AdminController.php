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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!User::author()) {
            return redirect('home');
        }

        $stripedMovies = Movie::all()->pluck('imbdId');

        $movies = [];

        $users = User::all();

        $actors = Actor::all();

        $genres = Genre::all();

        foreach ($stripedMovies as $movie) {
            array_push($movies,$movie);
        }



        if(User::editor()) {
            $moviesToEdit = Movie::all();
        } else {
            $moviesToEdit = Movie::where('added_by','=', auth()->id())->get();
        }

        return view('admin.index',compact('movies','moviesToEdit','users','actors','genres'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sync(Request $request)
    {
        return Admin::syncSingle($request);
    }

}
