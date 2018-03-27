<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

    //This method is used to get all movies that are not in the specified wishlist
    //so they can be presented to the user when adding a movie to one of his wishlists
    public function getMovies(Request $request)
    {
        $valid = $this->validate($request,[
            'name' => 'required'
        ]);

        $wl = Wishlist::where('name',$request->input('name'))->first();
        $movies = DB::table('movies')
            ->whereNotIn('id',$wl->movies->pluck('id')->toArray())
            ->pluck('id','title')
            ->toArray();

        return $movies;
    }

    public function update(Request $request,$id)
    {
        $listName = $id;

        $valid = $this->validate($request,[
            'title' => 'required|integer'
        ]);

        $wl = Wishlist::where('name',$id)->first();
        $wl->movies()->attach($valid['title']);

        session()->flash('message','Movies has been added.');
        return back();
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request,[
            'name' => 'required'
        ]);

        DB::table('wishlists')
            ->insert([
                'name' => $valid['name'],
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        session()->flash('message','Wishlist has been created.');

        return back();
    }

    public function destroy($id)
    {
        $wl = Wishlist::findOrFail($id);
        $wl->movies()->detach();
        $wl->delete();

        session()->flash('message','Wishlist has been deleted.');

        return back();
    }

    //This method is used to remove a movie from a list
    public function detach($wid, $mid)
    {
        $wl = Wishlist::findOrFail($wid);
        $wl->movies()->detach($mid);

        session()->flash('message','Movie has been removed.');
        return back();
    }

    public function attach($wid,$mid)
    {
        $wl = Wishlist::findOrFail($wid);
        $wl->movies()->attach($mid);

        session()->flash('message','Movie has been added.');
        return back();
    }
}
