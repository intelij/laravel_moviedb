<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Provider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PragmaRX\Google2FALaravel\Google2FA;


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

    public function getValidateToken()
    {
        if (session('2fa:user:id')) {
            return view('auth.google2fa.index');
        }

        return redirect('login');

    }

    public function validate2FA(Request $request)
    {
        $this->validate($request,[
            'one_time_password' => 'required|digits:6'
        ]);
        $userId = $request->session()->get('2fa:user:id');
        $secret = User::find($userId)->google2fa_secret;

        $fa = app('pragmarx.google2fa');

        if($fa->verifyKey($secret,$request->input('one_time_password'))) {
            Auth::loginUsingId($userId);

            return redirect()->intended($this->redirectTo);
        }
        else {
            session()->flash('message','Not A Valid Key');

            return back();
        }
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
