<?php

namespace Framework\Http;

use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Pipeline\Pipeline;
use Psr\Http\Message\ServerRequestInterface;

class Application extends Pipeline
{
    private $resolver;
    private $default;

    public function __construct(MiddlewareResolver $resolver, callable $next)
    {
        parent::__construct();
        $this->resolver = $resolver;
        $this->default = $next;
    }

    public function pipe(callable $middleware)
    {
        parent::pipe($this->resolver->resolve($middleware));
    }

    public function run(ServerRequestInterface $request)
    {
        return $this($request, $this->default);
    }
}