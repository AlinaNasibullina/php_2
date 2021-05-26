<?php

return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=shop_brand',
        'user' => 'root',
        'password' => 'root',
    ],
    'templates' => __DIR__ . '/../templates',
    'routing' => [
        'login' => 'personalAccount/login',
        'logout' => 'personalAccount/logout',
        '(\w+)\/(\w+)' => '<controller>/<action>',
        '(\w+)' => '<controller>/index',
        '^$' => 'index/index',
        '(.*)' => 'index/error',
    ]
];