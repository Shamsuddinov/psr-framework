<?php

use App\Http\Middleware;

return [
    'dependencies' => [
        'factories' => [
            Middleware\BasicAuthMiddleware::class => function(\Psr\Container\ContainerInterface $container){
                return new Middleware\BasicAuthMiddleware($container->get('config')['auth']['users']);
            }
//            Middleware\BasicAuthMiddleware::class => Infrastructure\App\Http\Middleware\BasicAuthMiddlewareFactory::class,
        ],
    ],
    'auth' => [
        'users' => [],
    ],
];