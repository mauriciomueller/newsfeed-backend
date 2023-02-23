<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?Response
    {
        if (! $request->expectsJson()) {
            return abort(401, 'Unauthorized');
        }

        return null;
    }
}
