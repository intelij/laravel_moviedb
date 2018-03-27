<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Provider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        if(Provider::where('provider_id',$user->id)->count() > 0) {

            $userId = Provider::where('provider_id',$user->id)->first()->user_id;

            $logUser = User::find($userId);
            auth()->login($logUser);

            return redirect()->home();

        } else {

            if(User::where('email',$user->email)->count() > 0) {

                $existingUser = User::where('email',$user->email)->first();

                $newProvider = new Provider;

                $newProvider->name = $provider;

                $newProvider->provider_id = $user->id;

                $newProvider->user_id = $existingUser->id;

                $newProvider->save();

                auth()->login($existingUser);

                return redirect()->home();

            } else {

                $newUser = new User;

                $newUser->name = $user->name;

                $newUser->email = $user->email;

                $newUser->save();

                $newProvider = new Provider;

                $newProvider->name = $provider;

                $newProvider->provider_id = $user->id;

                $newProvider->user_id = $newUser->id;

                $newProvider->save();

                auth()->login($newUser);

                return redirect()->home();
            }


        }

    }
}
