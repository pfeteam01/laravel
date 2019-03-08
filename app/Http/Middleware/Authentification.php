<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class Authentification => c'est le middleware de l'authentification
 * @package App\Http\Middleware
 */
class Authentification
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
        if (auth()->guest()){
            flash('Vous devez vous connecter pour pouvoir afficher cette page')->error();
            return redirect('/connexion');
        }
        return $next($request);
    }
}
