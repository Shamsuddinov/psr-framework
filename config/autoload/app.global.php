<?php


use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use \App\Http\Middleware;

return [
    'dependencies' => [
        'abstract_factories' => [
            ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => function (ContainerInterface $container) {
                $app = new Application(
                    $container->get(MiddlewareResolver::class),
                    $container->get(Router::class),
                    new Middleware\NotFoundHandler(),
                    new Zend\Diactoros\Response()
                );
                $app->setLogger($container->get(\Psr\Log\LoggerInterface::class));
            },
            Router::class => function () {
                return new AuraRouterAdapter(new \Aura\Router\RouterContainer());
            },
            MiddlewareResolver::class => function (ContainerInterface $container) {
                return new MiddlewareResolver($container);
            },
            Middleware\ErrorHandlerMiddleware::class => function (ContainerInterface $container) {
                return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
            },
            TemplateRenderer::class => function () {
                return new TemplateRenderer('templates');
            },
        ]
    ],
    'debug' => false,
];