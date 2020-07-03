<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if (Auth::guard($guard)->check()) {
            return redirect('/index');
        }*/

        //追加 ここから
        $redir = '/index';
        switch ($guard) {
        case "admin":
             $redir = '/admin/index';
             break;
         default:
             $redir = '/index';
             break;
         }
         if (Auth::guard($guard)->check()) {
            return redirect($redir);
         }
         //ここまで
        return $next($request);
    }
}
