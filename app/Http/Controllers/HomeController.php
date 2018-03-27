<?php

namespace App\Http\Controllers;

use App\Genre;
use App\User;
use Illuminate\Http\Request;
use App\Movie;
use App\Recommend;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top = Movie::top();
        $ranks = [];

        if(auth()->check()) {

            if(auth()->user()->ratings->count() > 5) {

                $array = Movie::recommenderArray();
                $user = User::find(auth()->id())->name;
                $ranks = new Recommend();
                $ranks = $ranks->getRecommendations($array,$user);

                if(count($ranks) > 5) {
                    $ranks = array_slice($ranks,0,5);
                }

            }
        }


        return view('index.index',compact('top','ranks'));
    }

    public function destroy()
    {
        if(auth()->check())
        {
            auth()->logout();
            session()->invalidate();
        }

        return redirect('home');
    }
}
