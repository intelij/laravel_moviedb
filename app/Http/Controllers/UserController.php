<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\User;
use App\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);

        try {
            $id = DB::table('users')
                ->insertGetId([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'added_by' => auth()->id()
                ]);

            if($validatedData['role'] != 0) {
                User::find($id)->roles()->attach($validatedData['role']);
            }

            return redirect('admin');
        } catch (Exception $e) {
            return response($e,'500');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::findOrFail($id);
        $wishlists = $user->wishlists;
        $avatarUrl = '/storage/images/brand/Plus-sign.png';

        $hasAvatar = $user->hasAvatar($id);

        if($hasAvatar) {
            $avatarUrl = '/storage/avatars/'.$id.'.jpg';
        }



        return view('user.show',compact('wishlists','user','id','avatarUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $role = $user->roles->first();

        if(empty($role)) {
            $role = "none";
        }

        return view('user.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $validData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'role' => 'required'
        ]);

        DB::table('users')
            ->where('id','=',$id)
            ->update([
                'name' => $validData['name'],
                'email' => $validData['email'],
            ]);
        if(!empty($validData['password'])) {
            DB::table('users')
                ->where('id','=',$id)
                ->update([
                    'password' => bcrypt($validData['password']),
                ]);
        }

        $user = User::findOrFail($id);

        if($validData['role'] === "none") {
            $user->roles()->detach();
        } else {
            $user->roles()->detach();
            $user->roles()->attach($validData['role']);
        }

        session()->flash('message','The user was successfully updated.');
        return back();

    }


    public function updateRoll(Request $request)
    {

        $this->validate($request,[
            'users' => 'required',
            'new_role' => 'required'
        ]);

        $user_id = $request->input('users');
        $role_id = $request->input('new_role');

        $user = User::find($user_id);

        if($user->roles->count() > 0) {
            $user->roles()->detach();
            $user->roles()->attach($role_id);
        } else {
            $user->roles()->attach($role_id);
        }

        session()->flash('message','Role successfully changed.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('userToDelete');
        $movie = User::findOrFail($id);
        $movie->roles()->detach();
        $movie->delete();


        session()->flash('Movie has been deleted.');

        return redirect('admin');
    }

    public function getRating(Request $request)
    {
        if(auth()->check()) {
            $rating = auth()->user()->ratings->where('movie_id','=',$request->input('mid'));
            if($rating->count()>0)
            {
                return $rating->first()->rating;
            }
            else {
                return response('User has no rating');
            }
        }
        return redirect('home');
    }

    public function rate(Request $request)
    {
        if(auth()->check() && User::subscriber()) {

            if(auth()->user()->ratings->where('movie_id','=',$request->input('mid'))->count() > 0) {
                $rating = DB::table('ratings')
                    ->where('user_id',auth()->id())
                    ->where('movie_id', $request->input('mid'))
                    ->update([
                        'rating' => $request->input('rating'),
                        'updated_at' => now()
                    ]);

                Movie::find($request->input('mid'))->searchable();

            } else {

                try {
                    $rating = Rating::create([
                        'rating' => $request->input('rating'),
                        'user_id' => auth()->id(),
                        'movie_id' => $request->input('mid')
                    ]);

                    $rating->movie->searchable();
                } catch (Exception $e) {
                    return $e;
                }
            }

            session()->flash('message','You rating was recorded.');

            return response('Rating created',200);
        }
        return redirect('home');
    }

    public function showAvatarForm($id)
    {
        $hasAvatar = auth()->user()->hasAvatar($id);
        return view('user.avatar',compact('id','hasAvatar'));
    }

    public function avatar(Request $request)
    {
        $id = $request->user()->id;
        $file = $request->file('avatar');
        $type = $file->getMimeType();
        $size = $file->getSize();
        $path = $file->getPathname();


        if( $type !== 'image/jpeg' && $type !== 'image/png' ) {
            session()->flash('message','Please put a valid image!');

            return redirect()->back();
        }

        if( $size <= 1024 ) {
            session()->flash('message','Please put a valid image!');

            return redirect()->back();
        }

        if( $size > 5*1024*1024 ) {
            session()->flash('message','Maximum size is 5MB!');

            return redirect()->back();
        }

        $img = Image::make($file);

        $img->fit(150);

        $img->save(storage_path('app/public/avatars/'.$id.'.jpg'));

        session()->flash('message','Your avatar has been updated!');

        return redirect()->route('user.show',$id);
    }
}
