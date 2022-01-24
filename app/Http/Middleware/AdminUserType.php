<?php

namespace App\Http\Middleware;

use Closure;

class AdminUserType
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
        $payload = auth()->payload();
        
        if ($payload['user_type'] == 'admin_user') {
            return $next($request);
        }
        
        return response()->json(['message' => 'Unauthorized'],401);


        return $next($request);
    }
}
