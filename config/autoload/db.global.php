<?php


return [
    'dependencies' => [
        'factories' => [
            PDO::class => function () {
                return new PDO(
                    'sqlite:db/db.sqlite',
                    'user',
                    'password',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ]
                );
            }
        ],
    ],

    'pdo' => [
        'options' =>  [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    ],
];