<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class CredentialsMiddleware
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $response = $next($request);

        return $response->withHeader('X-Developer', 'Abbosxon');
    }
}