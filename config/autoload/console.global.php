<?php

use App\Console\Command\CacheClearCommand;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            CacheClearCommand::class => CacheClearCommand::class,
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