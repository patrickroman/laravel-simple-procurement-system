<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateWithBasicAuth
{
    public function handle($request, Closure $next)
    {
        return $this->authenticate() ?: $this->unauthenticated();
    }

    protected function authenticate()
    {
        return $this->protect(request());
    }

    protected function unauthenticated()
    {
        return response()->json(['message' => 'Authentication failed.'], 401);
    }

    protected function protect($request)
    {
        $credentials = $request->only('Email', 'Password');

        if (auth()->attempt($credentials)) {
            return;
        }
        dd($credentials);
        return response()->json(['message' => 'Authentication failed.'], 401);
    }
}
