<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
class activate
{
    
    public function handle($request, Closure $next)
    {
        $userId=auth()->user()->id;
        $user=User::where('id',$userId)
                    ->where('role','vendor')
                    ->first();

        if ($user!=null) {
            if($user->activate=='0'){
                 return redirect('api_login');

            }

            
        }
        return $next($request);
    }
}
