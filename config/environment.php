<?php

return [
    'DB' => [
        'default' => [
            'host' => getenv('MYSQL_HOST_URL'),
            'dbname' => 'boxmeup',
            'user' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD')
        ]
    ],
    'Security' => [
        'salt_base' => getenv('SALT')
    ],
    'Debug' => [
        'toolbar' => getenv('DEBUG')
    ]
];
