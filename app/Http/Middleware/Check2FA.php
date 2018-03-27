<?php

namespace App\Http\Middleware;

use Closure;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(auth()->check()) {
            if(is_null(auth()->user()->google2fa_secret)) {
                return $next($request);
            }

            if(!is_null(auth()->user()->google2fa_secret) && $request->session()->get('auth_passed')) {
                return $next($request);
            } else {
                $request->session()->put('2fa:user:id',$request->user()->id);
                return redirect()->route('google2fa.validateToken');
            }
        }
        else {
            return $next($request);
        }

    }
}
