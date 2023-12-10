<?php

use App\Http\Middleware;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

return [
    'dependencies' => [
        'factories' => [
            Middleware\BasicAuthMiddleware::class => function(ContainerInterface $container){
                return new Middleware\BasicAuthMiddleware($container->get('config')['auth']['users'], new Response());
            }
//            Middleware\BasicAuthMiddleware::class => Infrastructure\App\Http\Middleware\BasicAuthMiddlewareFactory::class,
        ],
    ],
    'auth' => [
        'users' => [],
    ],
];