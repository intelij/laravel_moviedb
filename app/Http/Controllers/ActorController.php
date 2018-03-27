<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actor;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request)
    {
        $name = $request->input('actor');

        $movies = Actor::where('name','=',$name)->first()->movies;

        return view('movie.byActor',compact('movies','name'));
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request,[
            'name' => 'required|string'
        ]);

        DB::table('actors')
            ->insert([
                'name' => $valid['name'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        session()->flash('message','Actor has been added.');

        return redirect('admin');
    }

    public function create()
    {
        return view('actor.create');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('actorToDelete');

        $actor = Actor::find($id);
        $actor->movies()->detach();
        $actor->delete();

        session()->flash('message','Actor '.$actor->name.' has been deleted');

        return redirect('admin');
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        return view('actor.edit',compact('actor'));
    }

    public function update(Request $request,$id)
    {
        $valid = $this->validate($request,[
            'name' => 'required'
        ]);

        DB::table('actors')
            ->where('id',$id)
            ->update([
                'name' => $valid['name']
            ]);

        session()->flash('message','Actor has been updated.');

        return redirect('admin');

    }
}
