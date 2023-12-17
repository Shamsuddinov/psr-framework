<?php

use App\Console\Command\CacheClearCommand;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            CacheClearCommand::class => function (ContainerInterface $container) {
                return new CacheClearCommand(
                    $container->get('config')['console']['cachePaths']
                );
            },
        ],
    ],
    'console' => [
        'cachePaths' => [
            'twig' => 'var/cache/twig',
            'db' => 'var/cache/db',
        ]
    ]
];