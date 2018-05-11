<?php

/** 
 * Learning PHP
 * 
 * PHP version 7.2
 * 
 * @category Learning_PHP
 * @package  Configuration
 * @author   Kalnynsh <kda869@yandex.ru>
 * @license  http://example.com MIT 
 * @link     https://github.com/kalnynsh 
 */

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
        ],
        'session' => [
            'class' => \app\services\Session::class,
        ],
    ],
];
