<?php

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Pipeline\Pipeline;
use Laminas\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application extends Pipeline
{
    private $resolver;
    private $default;

    public function __construct(MiddlewareResolver $resolver, callable $default, ResponseInterface $responsePrototype)
    {
        parent::__construct();
        $this->resolver = $resolver;
        $this->setResponsePrototype($responsePrototype);
        $this->default = $default;
    }

    public function pipe($path, callable $middleware = null)
    {
        if ($middleware === null){
            return parent::pipe($this->resolver->resolve($path,$this->responsePrototype));;
        }
        return parent::pipe($path, $this->resolver->resolve($middleware, $this->responsePrototype));
    }

    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this($request, $response, $this->default);
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