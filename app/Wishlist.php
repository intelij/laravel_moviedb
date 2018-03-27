<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['name','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public static function wishlistLimit($id)
    {
        $user = User::findOrFail($id);

        if($user->roles->count() == 0) {
            return 1;
        } elseif ($user->subscriptions->count() == 0) {
            return 5;
        } else {
            if($user->subscriptions->first()->name == 'basic') {
                return 3;
            } elseif($user->subscriptions->first()->name == 'regular') {
                return 5;
            } else {
                return INF;
            }
        }
    }

    public static function movieLimit($id)
    {
        $user = User::findOrFail($id);
        if($user->roles->count() == 0) {
            return 5;
        } elseif ($user->subscriptions->count() == 0) {
            return 5;
        }
        else {
            if($user->subscriptions->first()->name == 'basic') {
                return 10;
            } else {
                return INF;
            }
        }
    }
}
