<?php

namespace Framework\Http\Pipeline;

use Framework\Http\Middleware\Exception\UnknownMiddlewareTypeException;
use Laminas\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareResolver
{
    public function resolve($handler, ResponseInterface $responsePrototype): mixed
    {
        if (\is_array($handler)) {
            return $this->createPipe($handler, $responsePrototype);
        }

        if (\is_string($handler)) {
            return function (ServerRequestInterface $request, ResponseInterface $response, mixed $next) use ($handler) {
                $middleware = $this->resolve(new $handler(), $response);
                return $middleware($request, $response, $next);
            };
        }

        if ($handler instanceof MiddlewareInterface){
            return function (ServerRequestInterface $request, ResponseInterface $response, mixed $next) use ($handler){
                return $handler->process($request, new InteropHandlerWrapper($next));
            };
        }

        if (\is_object($handler)){
            $reflection = new \ReflectionObject($handler);
            if ($reflection->hasMethod('__invoke')){
                $method = $reflection->getMethod('__invoke');
                $parameters = $method->getParameters();

                if (count($parameters) === 2 && $parameters[1]->getType()){
                    return function (ServerRequestInterface $request, ResponseInterface $response, mixed $next) use($handler){
                        return $handler($request, $next);
                    };
                }
                return $handler;
            }
        }

        throw new UnknownMiddlewareTypeException($handler);
    }

    private function createPipe(array $handlers, $responsePrototype): MiddlewarePipe
    {
        $pipeline = new MiddlewarePipe();
        $pipeline->setResponsePrototype($responsePrototype);

        foreach ($handlers as $handler) {
            $pipeline->pipe($this->resolve($handler, $responsePrototype));
        }

        return $pipeline;
    }
}