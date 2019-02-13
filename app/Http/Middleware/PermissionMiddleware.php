<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
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
        $action = $request->route()->getAction();
        $controllerAction = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        $controller = str_replace('Controller', '', $controller);
        $controllers[$controller][] = $action;
        $permission = $controller.'_'.$action;
        $user = Auth::user();
        if($user->hasPermissionTo($permission)){
            return $next($request);
        }else{
            return redirect()->back()->with('warning','Đừng đùa với ninza rùa!');
        }
    }
}
