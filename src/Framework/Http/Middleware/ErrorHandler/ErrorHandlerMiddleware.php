<?php

namespace Framework\Http\Middleware\ErrorHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    private $responseGenerator;
    private $listeners = [];

    public function __construct(ErrorResponseGenerator $responseGenerator)
    {
        $this->responseGenerator = $responseGenerator;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\Throwable $throwable) {
            foreach ($this->listeners as $listener) {
                $listener($throwable, $request);
            }

            return $this->responseGenerator->generate($throwable, $request);
        }
    }

    public function addListener($listener)
    {
        $this->listeners[] = $listener;
    }
}
