<?php

namespace App\Http\Middleware;

use Closure;

class Loggedin
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
        
        // if (session()->has('loggedin') == 'true'){
        //     if(session()->get('role')=="admin"){
        //             return $next($request);
        //     }
            
            
        // }
        // return redirect("login");
        if(auth()->user() == null){
            return redirect("/login");
        }
        if (!session()->has('loggedin') == 'true') {
            return redirect("login");
        }
        return $next($request);
    }
}
