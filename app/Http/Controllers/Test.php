<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class Test extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();

        dd($user);
    }
}
