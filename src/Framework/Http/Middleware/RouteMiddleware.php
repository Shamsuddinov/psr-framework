<?php

namespace Framework\Http\Middleware;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Result;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouteMiddleware implements MiddlewareInterface
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $result = $this->router->match($request);

            foreach ($request->getAttributes() as $attribute => $value) {
                $request = $request->withAttribute($attribute, $value);
            }

            return $handler->handle($request->withAttribute(Result::class, $result));
        } catch (RequestNotMatchedException $exception) {
            return $handler->handle($request);
        }
    }
}


// 3-dars 1- holat
//use Framework\Http\Pipeline\MiddlewareResolver;
//use Framework\Http\Router\Exception\RequestNotMatchedException;
//use Framework\Http\Router\Router;
//use Psr\Http\Message\ServerRequestInterface;
//
//class RouteMiddleware
//{
//    private $router;
//    private $resolver;
//
//    public function __construct(Router $router, MiddlewareResolver $resolver)
//    {
//        $this->router = $router;
//        $this->resolver = $resolver;
//    }
//
//    public function __invoke(ServerRequestInterface $request, callable $next)
//    {
//        try {
//            $result = $this->router->match($request);
//
//            foreach ($request->getAttributes() as $attribute => $value){
//                $request = $request->withAttribute($attribute, $value);
//            }
//
//            $middleware = $this->resolver->resolve($result->getHandler());
//
//            return $middleware($request, $next);
//        } catch (RequestNotMatchedException $exception){
//            return $next($request);
//        }
//    }
//}
