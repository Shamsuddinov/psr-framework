<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ErrorHandlerMiddleware
{
    private $debug;

    public function __construct($debug)
    {
        $this->debug = $debug;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $throwable){
            if ($this->debug){
                return new JsonResponse([
                    'error' => 'Server side error',
                    'code' => $throwable->getCode(),
                    'message' => $throwable->getMessage(),
                ]);
            }
        }
    }
}