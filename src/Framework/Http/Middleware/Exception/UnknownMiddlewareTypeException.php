<?php

namespace Framework\Http\Middleware\Exception;

use Psr\Http\Message\ServerRequestInterface;

class UnknownMiddlewareTypeException extends \LogicException
{
    private $type;

    public function __construct(callable $type)
    {
        parent::__construct('Unknown middleware type!');
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}