<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','added_by','google2fa_secret'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','google2fa_secret'
    ];

    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    public function getGoogle2faSecretAttribute($value)
    {
        return decrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public  function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public static function subscriber()
    {
        $user = auth()->user();
        if(auth()->user()->roles->count() > 0 ) {
            $roleName = $user->roles->first()->name;
            if($roleName == 'subscriber' || $roleName == 'author' ||$roleName == 'editor' || $roleName == 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function author()
    {
        $user = auth()->user();
        if(auth()->user()->roles->count() > 0 ) {
            $roleName = $user->roles->first()->name;
            if($roleName == 'author' ||$roleName == 'editor' || $roleName == 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function editor()
    {
        $user = auth()->user();
        if(auth()->user()->roles->count() > 0 ) {
            $roleName = $user->roles->first()->name;
            if($roleName == 'editor' || $roleName == 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function admin()
    {
        $user = auth()->user();
        if(auth()->user()->roles->count() > 0 ) {
            $roleName = $user->roles->first()->name;
            if($roleName == 'admin') {
                return true;
            }
        }
        return false;
    }

}
