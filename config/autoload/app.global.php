<?php

use Framework\Http\Application;
use Framework\Http\Middleware\ErrorHandler\ErrorHandlerMiddleware;
use Framework\Http\Middleware\ErrorHandler\ErrorResponseGenerator;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\Router;
use Infrastructure\App\Logger\LoggerFactory;
use Infrastructure\Framework\Http\ApplicationFactory;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\ErrorHandlerMiddlewareFactory;
use Infrastructure\Framework\Http\Middleware\ErrorHandler\PrettyErrorResponseGeneratorFactory;
use Infrastructure\Framework\Http\Pipeline\MiddlewareResolverFactory;
use Infrastructure\Framework\Http\Router\AuraRouterFactory;

return [
    'dependencies' => [
//        'abstract_factories' => [
//            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
//        ],
        'factories' => [
            Application::class => ApplicationFactory::class,
            Router::class => AuraRouterFactory::class,
            MiddlewareResolver::class => MiddlewareResolverFactory::class,
            ErrorHandlerMiddleware::class => ErrorHandlerMiddlewareFactory::class,
            ErrorResponseGenerator::class => PrettyErrorResponseGeneratorFactory::class,
            Psr\Log\LoggerInterface::class => LoggerFactory::class,
        ],
    ],

    'debug' => false,
];