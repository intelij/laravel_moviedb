<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest')->except('register2FA','completeRegistration','disable2FA');
        $this->middleware('auth')->only('register2FA','completeRegistration','disable2FA');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register2FA(Request $request)
    {
        $google2fa = app('pragmarx.google2fa');

        $secret = $google2fa->generateSecretKey();

        $request->session()->flash('secret_code',$secret);

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $request->user()->email,
            $secret
        );

        return view('auth.google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $secret]);
    }

    public function completeRegistration(Request $request)
    {
        $secret = $request->session()->get('secret_code');

        $user = $request->user();

        $user->google2fa_secret = $secret;
        $user->save();

        session()->flash('message','2FA Enabled.');

        return redirect()->route('user.show',$user->id);
    }

    public function disable2FA(Request $request)
    {
        $user = $request->user();

        $user->google2fa_secret = null;

        $user->save();

        session()->flash('message','2FA Disabled');

        return redirect()->route('user.show',$user->id);
    }
}
