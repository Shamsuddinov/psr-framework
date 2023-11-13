<?php

namespace Framework\Http\Router;

use Psr\Http\Message\ServerRequestInterface;

class Route
{
    public $name;
    public $pattern;
    public $handler;
    public $methods;
    public $tokens;

    public function __construct($name, $pattern, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }

//    public function match(ServerRequestInterface  $request){
//        if ($this->methods && !\in_array($request->getMethod(), $this->methods, true)){
//            return null;
//        }
//
//        $pattern = preg_replace_callback('~\{([^\])}\~', function ($matches) {
//            $argument = $matches[1];
//            $replace = $this->methods[$argument] ?? '[^}]+';
//
//            return '(?P<' . $argument . '>' . $replace . ')';
//        }, $this->pattern);
//
//        $path = $request->getUri()->getPath();
//    }
}