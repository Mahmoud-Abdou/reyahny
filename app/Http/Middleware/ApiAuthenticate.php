<?php
namespace App\Http\Middleware;

use App\Exceptions\JWTInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
use App\User;

class ApiAuthenticate
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
        // dd("api_auth");
        $user = User::where('id', $request->header('user_id'))
            ->where('access_token', $request->header('auth_token'))
            ->first();
            
        if ($user == null) {
            // return response()->json(['error' => 'Wrong Token'], 404);
            $output['error'] = 'Wrong Token';
            $output['code'] = 404;

            return  response()->json($output, 400, [], JSON_UNESCAPED_UNICODE);
        }
        return $next($request);
    }
}
