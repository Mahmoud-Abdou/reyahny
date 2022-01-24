<?php

namespace App\Http\Middleware;

use Closure;

class publicUserType
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
        if ($payload['user_type'] == 'public_user') {
            return $next($request);
        }
        
        return response()->json(['message' => 'Unauthorized'],401);
        
    }
}
