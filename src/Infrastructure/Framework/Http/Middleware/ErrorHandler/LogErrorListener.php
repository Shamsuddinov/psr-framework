<?php

namespace Infrastructure\Framework\Http\Middleware\ErrorHandler;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class LogErrorListener
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(\Throwable $throwable, ServerRequestInterface $request)
    {
        $this->logger->error($throwable->getMessage(), [
            'exception' => $throwable,
            'request' => self::extractRequest($request)
        ]);
    }

    private static function extractRequest(ServerRequestInterface $request): array
    {
        return [
            'method' => $request->getMethod(),
            'url' => $request->getUri(),
            'server' => $request->getServerParams(),
            'cookies' => $request->getCookieParams(),
            'body' => $request->getParsedBody(),
        ];
    }
}
