<?php

use App\Console\Command\CacheClearCommand;

return [
    'dependencies' => [
        'factories' => [
            CacheClearCommand::class => CacheClearCommand::class,
        ],
    ],
];