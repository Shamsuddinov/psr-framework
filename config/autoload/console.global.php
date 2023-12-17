<?php

use App\Console\Command\CacheClearCommand;
use App\Service\FileManager;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            CacheClearCommand::class => function (ContainerInterface $container) {
                return new CacheClearCommand(
                    $container->get('config')['console']['cachePaths'],
                    $container->get(FileManager::class)
                );
            },
        ],
    ],
    'console' => [
        'commands' => [
            CacheClearCommand::class
        ],
        'cachePaths' => [
            'twig' => 'var/cache/twig',
            'db' => 'var/cache/db',
        ]
    ]
];