<?php

namespace App\Middleware;

class Auth
{
	/**
	 * Verify if user is logged.
	 *
	 * @param  Request $request
	 * @param  Closure $next
	 * @return Closure
	 */
    public function handle($request, $next)
    {
        $url = server('REQUEST_URI') ?? server('PATH_INFO');

        if (!auth()) {
            return redirect("/login?redirect=$url");
        }

        return $next($request);
    }
}
