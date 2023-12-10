<?php

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements ServerRequestInterface
{
    private $queryParams;
    private $parsedBody;
    private $serverParams;
    private $cookieParams;
    private $protocolVersion;

    public function __construct(array $queryParams = [], array $parsedBody = null)
    {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
    }
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function withQueryParams($queryParams): self
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    public function getParsedBody(): ?array
    {
        return $this->parsedBody;
    }

    public function withParsedBody($parsedBody): self
    {
        $this->parsedBody = $parsedBody;

        return $this;
    }

    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    public function getCookieParams(): array
    {
        return $this->cookieParams;
    }

    public function withCookieParams(array $cookies): self
    {
        return $this;
    }

    public function getUploadedFiles(): array
    {
        return $_FILES;
    }

    public function withUploadedFiles(array $uploadedFiles): self
    {
        return $this;
    }

    public function getAttributes(): array
    {
        return [];
    }

    public function getAttribute(string $name, $default = null)
    {
        $params = $this->getQueryParams();

        return $params[$name] ?? null;
    }

    public function withAttribute(string $name, $value): self
    {
        return $this;
    }

    public function withoutAttribute(string $name): self
    {
        return $this;
    }

    public function getProtocolVersion(): string
    {
        // TODO: Implement getProtocolVersion() method.
        return $this->protocolVersion;
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        // TODO: Implement withProtocolVersion() method.
        return $this;
    }

    public function getHeaders(): array
    {
        // TODO: Implement getHeaders() method.
        return [];
    }

    public function hasHeader(string $name): bool
    {
        // TODO: Implement hasHeader() method.
        return true;
    }

    public function getHeader(string $name): array
    {
        // TODO: Implement getHeader() method.
        return [];
    }

    public function getHeaderLine(string $name): string
    {
        // TODO: Implement getHeaderLine() method.
        return "";
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        // TODO: Implement withHeader() method.
        return $this;
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        // TODO: Implement withAddedHeader() method.
        return $this;
    }

    public function withoutHeader(string $name): MessageInterface
    {
        // TODO: Implement withoutHeader() method.
        return $this;
    }

    public function getBody(): StreamInterface
    {
        // TODO: Implement getBody() method.
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        // TODO: Implement withBody() method.
        return $this;
    }

    public function getRequestTarget(): string
    {
        // TODO: Implement getRequestTarget() method.
        return "";
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        // TODO: Implement withRequestTarget() method.
        return $this;
    }

    public function getMethod(): string
    {
        // TODO: Implement getMethod() method.
        return "";
    }

    public function withMethod(string $method): RequestInterface
    {
        // TODO: Implement withMethod() method.
        return $this;
    }

    public function getUri(): UriInterface
    {
        // TODO: Implement getUri() method.
        return $this;
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        // TODO: Implement withUri() method.
        return $this;
    }
}
