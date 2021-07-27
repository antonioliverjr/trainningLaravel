<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FunctionManagerIsValid
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
        $role = auth()->user()->id_roles;
        if ($role == 2 or $role == 1) {
            return $next($request);
        } else {
            return back()->withErrors('O usuário não tem permissão!');
        }
    }
}
