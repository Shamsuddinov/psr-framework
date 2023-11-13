<?php

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Pipeline
{
    private $queue;

    public function __construct()
    {
        $this->queue = new \SplQueue();
    }

    public function pipe(callable $middleware)
    {
        $this->queue->enqueue($middleware);
    }

    public function __invoke(ServerRequestInterface $request, callable $default):ResponseInterface
    {
        $delegate = new Next($this->queue, $default);

        return $delegate($request);
    }
}

//class Pipeline
//{
//    private $middleware = [];
//
//    public function __invoke(ServerRequestInterface $request, callable $default):ResponseInterface
//    {
//        return  $this->next($request, $default);
//    }
//
//    public function pipe(callable $middleware)
//    {
//        $this->middleware[] = $middleware;
//    }
//
//    private function next(ServerRequestInterface $request, callable $default): ResponseInterface
//    {
//        $current = array_shift($this->middleware);
//
//         return $current($request, function (ServerRequestInterface $request) use ($default){
//            return $this->next($request, $default);
//         });
//    }
//}