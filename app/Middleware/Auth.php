<?php

namespace App\Middleware;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (!session('authenticate')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
