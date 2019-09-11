<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;

class esAdmin
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->hasRole($role)||$request->user()->hasRole('gerente')) {
            return $next($request);
        }
        //return  response()->json($request->user()->hasAnyRole($roles));// 
        return abort(403, 'No tienes autorización para ingresar.');
       // return $next($request);

    }
}