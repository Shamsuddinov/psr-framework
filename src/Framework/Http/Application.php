<?php

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\RouteData;
use Framework\Http\Router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Stratigility\Middleware\PathMiddlewareDecorator;
use Zend\Stratigility\MiddlewarePipe;

class Application implements MiddlewareInterface, RequestHandlerInterface
{
    private $resolver;
    private $router;
    private $default;
    private $pipeline;
    private $responsePrototype;

    public function __construct(
        MiddlewareResolver $resolver,
        Router $router,
        RequestHandlerInterface $default,
        ResponseInterface $responsePrototype
    )
    {
        $this->resolver = $resolver;
        $this->router = $router;
        $this->pipeline = new MiddlewarePipe();
        $this->default = $default;
        $this->responsePrototype = $responsePrototype;
    }

    public function pipe($path, $middleware = null): void
    {
        if ($middleware === null) {
            $this->pipeline->pipe($this->resolver->resolve($path));
        } else {
            $this->pipeline->pipe(new PathMiddlewareDecorator($path, $this->resolver->resolve($middleware)));
        }
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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->pipeline->process($request, $this->default);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $this->pipeline->process($request, $handler);
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