<?php


return [
    'debug' => false,
    'auth' => [
        'users' => [
            'admin' => '12345'
        ]
    ],
    'pdo' => [
        'dsn' => 'sqlite:db/db.sqlite',
        'username' => '',
        'password' => '',
    ],
    'phinx' => [
        'database' => 'sqlite:db/db.sqlite',
//        'username' => '',
//        'password' => '',
    ]
];