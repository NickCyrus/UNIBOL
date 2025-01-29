<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ControlModules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        

       
        if ( access_module() || getCurrentRouteGroup() == 'home' ){
            return $next($request);
        }else{
            return Redirect()->route('errorAccess');
        }
       

    }

}
