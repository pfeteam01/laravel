<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth ;

class RedirectIfNotAuthenticated
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
        if (Auth::guard('agence')->guest() && Auth::guard('user')->check()){
            return redirect('/loginagence')->withErrors('Chère agence, vous devez etre connectée afin de pouvoir voir cette page');
        }
        if (Auth::guard('user')->guest() && Auth::guard('agence')->check()){
            return redirect('/connexion')->withErrors('Chère utilisateur, vous devez etre connecté afin de pouvoir voir cette page');
        }
        if (Auth::guard('user')->guest() && Auth::guard('agence')->guest()){
            return redirect('/')->withErrors('Chèr client, vous devez etre connecté afin de pouvoir voir cette page');
        }
        return $next($request);
    }
}
