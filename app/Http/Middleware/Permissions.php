<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    private $exceptNames = [

        'LaravelInstaller*',
        'LaravelUpdater*',
        'debugbar*'
    ];

    private $exceptControllers = [
        'LoginController',
        'ForgotPasswordController',
        'ResetPasswordController',
        'RegisterController',
        'PayPalController'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permission = $request->route()->getName();
        // dd(Auth::user()->canNot($permission));
        // dd( auth()->user()->id);
        // $role=DB::table("model_has_roles")
        // ->join("roles", "roles.id", "model_has_roles.role_id")
        // ->join("role_has_permissions","role_has_permissions.role_id", "roles.id")
        // ->join("permissions", "permissions.id", "role_has_permissions.permission_id")
        // ->where("model_has_roles.model_id",  auth()->user()->id)
        // ->where("model_has_roles.model_type", "App\Models\User")
        // // ->where("permissions.name", $permission)
        // ->first();
        // dd(  $role);
        // if(auth()->user() == null){
        //     return redirect("/login");die;
        // }
        // dd(Auth::user() , $this->match($request->route()) , Auth::user()->canNot($permission));
        if (Auth::user() && $this->match($request->route())&0) 
        {
            throw new UnauthorizedException(403, 'error permission' . ' ' . $permission . '');
        }

        return $next($request);
    }

    private function match(\Illuminate\Routing\Route $route)
    {
        if ($route->getName() == '' || $route->getName() === null) {
            return false;
        } else {
            if (in_array(class_basename($route->getController()), $this->exceptControllers)) {
                return false;
            }
            foreach ($this->exceptNames as $except) {
                if (Str::is($except, $route->getName())) {
                    return false;
                }
            }
        }
        return true;
    }
}
