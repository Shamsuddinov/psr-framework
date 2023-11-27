<?php

use Framework\Container\Container;
use Framework\Http\Application;
use Framework\Http\Middleware\DispatchMiddleware;
use Framework\Http\Middleware\RouteMiddleware;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;
use App\Http\Middleware;

/**
 * @var ContainerInterface $container
 */

$container->set(Application::class, function (ContainerInterface $container){
    return new Application(
        $container->get(MiddlewareResolver::class),
        $container->get(Router::class),
        new Middleware\NotFoundHandler(),
        new Response()
    );
});

$container->set(Router::class, function (){
    return new AuraRouterAdapter(new \Aura\Router\RouterContainer());
});

$container->set(MiddlewareResolver::class, function (ContainerInterface $container){
    return new MiddlewareResolver($container);
});

// BasicAuth
$container->set(Middleware\BasicAuthMiddleware::class, function (ContainerInterface $container){
    return new Middleware\BasicAuthMiddleware($container->get('config')['user']);
});

$container->set(Middleware\ErrorHandlerMiddleware::class, function (ContainerInterface $container){
    return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
});

$container->set(DispatchMiddleware::class, function (ContainerInterface $container){
    return new DispatchMiddleware($container->get(MiddlewareResolver::class));
});

$container->set(RouteMiddleware::class, function (ContainerInterface $container){
    return new RouteMiddleware($container->get(Router::class));
});

$container->set(Middleware\CredentialsMiddleware::class, function (){
    return new Middleware\CredentialsMiddleware();
});

$container->set(Middleware\ProfilerMiddleware::class, function (){
    return new Middleware\ProfilerMiddleware();
});
