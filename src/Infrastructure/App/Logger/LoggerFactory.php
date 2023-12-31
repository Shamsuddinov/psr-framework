<?php

namespace Infrastructure\App\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $logger = new Logger('App');
        $logger->pushHandler(new StreamHandler(
            'var/log/application.log',
            $container->get('config')['debug'] ? Logger::DEBUG : Monolog\Logger::WARNING
        ));

        return $logger;
    }
}
