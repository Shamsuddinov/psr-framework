<?php

namespace Framework\Http\Middleware\Exception;

use Psr\Http\Message\ServerRequestInterface;

class UnknownMiddlewareTypeException extends \LogicException
{
    public function __construct(callable $handler)
    {
        parent::__construct('Unknown middleware type!');
    }
}