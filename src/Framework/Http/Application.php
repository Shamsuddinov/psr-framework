<?php

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\RouteData;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Middleware\PathMiddlewareDecorator;
use Zend\Stratigility\MiddlewarePipe;

class Application extends MiddlewarePipe
{
    private $resolver;
    private $router;
    private $default;

    public function __construct(MiddlewareResolver $resolver, Router $router, callable $default, ResponseInterface $responsePrototype)
    {
//        parent::__con
        $this->resolver = $resolver;
        $this->router = $router;
        $this->default = $default;
        $this->pipeline = new MiddlewarePipe();
//        $this->pipeline->setResponsePrototype($responsePrototype);
    }

    public function pipe($path, callable $middleware = null)
    {
        if ($middleware === null){
            $this->pipeline->pipe($this->resolver->resolve($path));
        }
        $this->pipeline->pipe(new PathMiddlewareDecorator($path, $this->resolver->resolve($middleware)));
    }

    private function route($name, $path, $handler, array $methods, array $options = []): void
    {
        $this->router->addRoute(new RouteData($name, $path, $handler, $methods, $options));
    }

    public function any($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, $options);
    }

    public function get($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['GET'], $options);
    }

    public function post($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['POST'], $options);
    }

    public function put($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PUT'], $options);
    }

    public function patch($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PATCH'], $options);
    }

    public function delete($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['DELETE'], $options);
    }

    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
//        return $this($request, $response, $this->default);
    }
}




//class Application extends Pipeline
//{
//    private $resolver;
//    private $default;
//
//    public function __construct(MiddlewareResolver $resolver, callable $next)
//    {
//        parent::__construct();
//        $this->resolver = $resolver;
//        $this->default = $next;
//    }
//
//    public function pipe(callable $middleware)
//    {
//        parent::pipe($this->resolver->resolve($middleware));
//    }
//
//    public function run(ServerRequestInterface $request, ResponseInterface $response)
//    {
//        return $this($request, $response, $this->default);
//    }
//}






// 3-dars eskisi
//class Application extends Pipeline
//{
//    private $resolver;
//    private $default;
//
//    public function __construct(MiddlewareResolver $resolver, callable $next)
//    {
//        parent::__construct();
//        $this->resolver = $resolver;
//        $this->default = $next;
//    }
//
//    public function pipe(callable $middleware)
//    {
//        parent::pipe($this->resolver->resolve($middleware));
//    }
//
//    public function run(ServerRequestInterface $request)
//    {
//        return $this($request, $this->default);
//    }
//}