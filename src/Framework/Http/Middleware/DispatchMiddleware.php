<?php

namespace Framework\Http\Middleware;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Result;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DispatchMiddleware implements MiddlewareInterface
{
    private $resolver;

    public function __construct(MiddlewareResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$result = $request->getAttribute(Result::class)) {
            return $handler->handle($request);
        }
        $middleware = $this->resolver->resolve($result->getHandler());

        return $middleware->process($request, $handler);


//        try {
//            if (!$result = $request->getAttribute(Result::class)){
//                return $next($request, $response);
//            }
//            $middleware = $this->resolver->resolve($result->getHandler());
//
//            return $middleware($request, $response, $next);
//        } catch (RequestNotMatchedException $exception){
//            return $next($request);
//        }
    }
}
