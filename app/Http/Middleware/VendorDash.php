<?php

namespace App\Http\Middleware;

use Closure;

class VendorDash
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
        // if(session()->get('role')=="vendor_dash"){
        //     return redirect("/vendors");

            
            
        // }
        // return redirect("/vendors");


    }
}
