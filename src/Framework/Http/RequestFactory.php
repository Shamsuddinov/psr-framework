<?php

namespace Framework\Http;

class RequestFactory
{
    public static function fromGlobals(array $queryParams = null, array $body = null): Request{
        return (new Request())
            ->withQueryParams($queryParams ?? $_GET)
            ->withParsedBody($body ?? $_POST);
    }
}