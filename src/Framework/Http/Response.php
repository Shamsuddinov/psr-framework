<?php

namespace Framework\Http;

class Response
{
    private $body;
    private $headers = [];
    private $statusCode;
    private $reasonPhrase = '';

    private static $phrases = [
        200 => "OK",
        301 => "Moved permanently",
        400 => "Bad request",
        403 => "Forbidden",
        404 => "Not found",
        500 => "Internal server error",
    ];

    public function __construct($body, $statusCode = 200)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withBody($body): Response
    {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function withStatusCode($statusCode, $reasonPhrase = ''): Response
    {
        $new = clone $this;
        $new->statusCode = $statusCode;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }

    public function getReasonPhrase(): string
    {
        if (!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }
        return $this->reasonPhrase;
    }

    public function withReasonPhrase($reasonPhrase): Response
    {
        $new = clone $this;
        $new->reasonPhrase = $reasonPhrase;
        return $new ;
    }

    public function getHeader($header): ?array
    {
        if (!$this->hasHeader($header)) {
            return null;
        }
        return $this->headers[$header];
    }

    public function hasHeader($header): bool
    {
        return isset($this->headers[$header]);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function withHeader($header, $value): Response
    {
        $new = clone $this;

        if ($new->hasHeader($header)) {
            unset($new->headers[$header]);
        }

        $new->headers[$header] = $value;

        return $new;
    }
}
