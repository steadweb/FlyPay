<?php declare(strict_types=1);

return [
    'settings' => [
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'app/Entities'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => getenv('DB_HOST'),
                'dbname'   => getenv('DB_NAME'),
                'user'     => getenv('DB_USER'),
                'password' => getenv('DB_PASS')
            ]
        ]
    ]
];
