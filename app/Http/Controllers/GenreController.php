<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request) {

        $movies = Genre::where('name','=',$request->input('genre'))->first()->movies;
        $name = $request->input('genre');

        return view('movie.byGenre',compact('name','movies'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request,[
            'name' => 'required'
        ]);

        if(Genre::where('name','=',$valid['name'])->exists()) {

            session()->flash('message','Genre already exists');
            return back();

        } else {

            DB::table('genres')
                ->insert([
                    'name' => $valid['name'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            session()->flash('message','Genre successfully created.');

            return redirect('admin');
        }

    }

    public function destroy(Request $request)
    {
        $id = $request->input('genreToDelete');

        $genre = Genre::find($id);
        $genre->movies()->detach();
        $genre->delete();

        session()->flash('message','Genre '.$genre->name.' has been deleted');

        return redirect('admin');
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('genres.edit',compact('genre'));
    }

    public function update(Request $request,$id)
    {
        $valid = $this->validate($request,[
            'name' => 'required'
        ]);

        DB::table('genres')
            ->where('id',$id)
            ->update([
                'name' => $valid['name']
            ]);

        session()->flash('message','Genre has been updated.');

        return redirect('admin');
    }
}
