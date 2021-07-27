<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FunctionAdminIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role=auth()->user()->id_roles;
        if($role <> 1)
        {
            return back()->withErrors('O usuário não tem permissão!');
        }else {
            return $next($request);
        }
    }
}
