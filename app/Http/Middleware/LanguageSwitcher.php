<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;

class LanguageSwitcher
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
        App::setLocale(Config('archive.language')[Auth::User()->language]);
        return $next($request);
    }
}
