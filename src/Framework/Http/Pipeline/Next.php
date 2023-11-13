<?php

namespace Framework\Http\Pipeline;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Next
{
    private $default;
    private $queue;

    public function __construct(\SplQueue $queue, callable $default)
    {
        $this->queue = $queue;
        $this->default = $default;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->queue->isEmpty()){
            return ($this->default)($request);
        }

        $current = $this->queue->dequeue();

        return $current($request, function (ServerRequestInterface $request){
            return $this($request);
        });
    }
}

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