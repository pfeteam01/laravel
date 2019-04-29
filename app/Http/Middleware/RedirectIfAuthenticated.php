<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard){
            case 'agence':
                if (Auth::guard($guard)->check()){
                    return redirect('/profilAgence')->withErrors('Chère agence, vous devez etre deconnétée afin de pouvoir voir cette page');
                }
                break;
            default:
                if (Auth::guard($guard)->check()){
                    return redirect('/profil')->withErrors('Chère utilisateur, vous devez etre deconnétée afin de pouvoir voir cette page');
                }
                break;
        }
        return $next($request);
    }
}
