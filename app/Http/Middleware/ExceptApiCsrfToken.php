<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class ExceptApiCsrfToken extends VerifyCsrfToken
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, \Closure $next)
    {
        // Check if the request is for API routes, and if so, skip CSRF token verification.
        if ($request->is('api/*') || $request->is('v1/*')) {
            return $next($request);
        }

        // For web routes, perform the regular CSRF token verification.
        return parent::handle($request, $next);
    }
}
