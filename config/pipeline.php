<?php

use App\Http\Middleware;
use Framework\Http\Application;

/**
 * @var Application $app
 */

$app->pipe(Middleware\ErrorHandler\ErrorHandlerMiddleware::class);
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe(\Framework\Http\Middleware\RouteMiddleware::class);
$app->pipe('cabinet', Middleware\BasicAuthMiddleware::class);
$app->pipe(\Framework\Http\Middleware\DispatchMiddleware::class);

///**
// * @var Application $app
// * @var Container $container
// */
//
//$app->pipe($container->get(Middleware\ErrorHandlerMiddleware::class));
////$app->pipe(Middleware\CredentialsMiddleware::class);
////$app->pipe(Middleware\ProfilerMiddleware::class);
//$app->pipe($container->get(\Framework\Http\Middleware\RouteMiddleware::class));
//$app->pipe('cabinet', $container->get(Middleware\BasicAuthMiddleware::class));
//$app->pipe($container->get(\Framework\Http\Middleware\DispatchMiddleware::class));
