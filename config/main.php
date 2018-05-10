<?php

return [
    'root_dir' => __DIR__ . '/../',
    'templates_dir' => __DIR__ . '/../views/',
    'controllers_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'd',
            'password' => 'Mc2tu7elq',
            'database' => 'd_edu01',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => \app\services\Request::class,
        ]
    ],
];
