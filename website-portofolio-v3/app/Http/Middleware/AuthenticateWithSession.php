<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class AuthenticateWithSession extends Authenticate
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('web')->check()) {
            $this->auth->shouldUse('web');
        }

        parent::authenticate($request, $guards);
    }
}