<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsUser
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
        if(Auth::check())
        {   
            //return "sdf";
            if(Auth()->user()->user_role_id==2) // user
            {
                return $next($request); 
            }
            elseif(Auth()->user()->user_role_id==2)
            {
                app('App\Http\Middleware\IsAdmin')->handle($request, function ($request) use ($next) {
                return $next($request);});
            }
            abort(404);

        }
        abort(404);
    }
}
