<?php
/**
 * SecureHeaders.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

/**
 *
 * Class SecureHeaders
 */
class SecureHeaders
{
    /**
     * Handle an incoming request. May not be a limited user (ie. Sandstorm env. or demo user).
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Frame-Options', 'deny');
        $response->header('Content-Security-Policy', "default-src 'none'; script-src 'self' 'unsafe-eval' 'unsafe-inline' https://www.google-analytics.com/analytics.js; style-src 'self' 'unsafe-inline';base-uri 'self';form-action 'self';font-src 'self';connect-src 'self';img-src 'self'");

        return $response;
    }
}