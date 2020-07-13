<?php

namespace App\Http\Middleware;

use Closure;

class TokenMiddleware
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
        if(!$request->session()->get('zohotoken')) {
            return redirect()->route('home');
        }
        else {
            $token = $request->session()->get('zohotoken');
            if($token->__get('accessToken') == '' || $token->__get('expiringTimestamp') <= time()) {
                return redirect()->route('logout');
            } 
        }

        return $next($request);
    }
}
