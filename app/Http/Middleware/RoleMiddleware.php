<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission=null)
    {
        $access = false;
        if (Auth::guest()) {
            return redirect('/');
        }

        if (! $request->user()->hasRole($role) ) {
            if(! $request->user()->can($permission))
                return redirect('/error/403');
        }

        return $next($request);
    }
}
