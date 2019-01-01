<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                if(Auth::guard('agent')->check()){
                    
                }else{
                    return response('Unauthorized.', 401);
                }
                
            } else {
                if (Auth::guard('agent')->check()) {
                }else{
                    return redirect()->route('login');
                }
               
            }
        }

        return $next($request);
    }
}
