<?php

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class Next
{
    private $queue;
    private $next;

    public function __construct(\SplQueue $queue, callable $next)
    {
        $this->queue = $queue;
        $this->next = $next;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($this->queue->isEmpty()){
            return ($this->next)($request, $response);
        }

        $middleware = $this->queue->dequeue();

        return $middleware($request, $response, function (ServerRequestInterface $request) use ($response){
            return $this($request, $response);
        });
    }
}

// 3-dars
//class Next
//{
//    private $default;
//    private $queue;
//    private $response;
//
//    public function __construct(\SplQueue $queue, ResponseInterface  $response, callable $default)
//    {
//        $this->queue = $queue;
//        $this->default = $default;
//        $this->response = $response;
//    }
//
//    public function __invoke(ServerRequestInterface $request): ResponseInterface
//    {
//        if ($this->queue->isEmpty()){
//            return ($this->default)($request);
//        }
//
//        $middleware = $this->queue->dequeue();
//
//        return $middleware($request, $this->response, function (ServerRequestInterface $request){
//            return $this($request);
//        });
//    }
//}

// 3-dars
//class Next
//{
//    private $default;
//    private $queue;
//
//    public function __construct(\SplQueue $queue, callable $default)
//    {
//        $this->queue = $queue;
//        $this->default = $default;
//    }
//
//    public function __invoke(ServerRequestInterface $request): ResponseInterface
//    {
//        if ($this->queue->isEmpty()){
//            return ($this->default)($request);
//        }
//
//        $current = $this->queue->dequeue();
//
//        return $current($request, function (ServerRequestInterface $request){
//            return $this($request);
//        });
//    }
//}

//1-variant
//class Next
//{
//    public function __invoke(\SplQueue $queue, ServerRequestInterface $request, callable $default): ResponseInterface
//    {
//        if ($queue->isEmpty()){
//            return $default($request);
//        }
//
//        $current = $queue->dequeue();
//
//        return $current($request, function (ServerRequestInterface $request) use ($queue, $default){
//            return $this($queue, $request, $default);
//        });
//    }
//}