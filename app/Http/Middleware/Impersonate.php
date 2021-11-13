<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Impersonate
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
        $impersonate = $request->session()->get('impersonate');
        if ($request->session()->has('impersonate')) {
            Auth::onceUsingId($impersonate);
        }
        return $next($request);
    }
}