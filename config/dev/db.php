<?php

use App\Models\DbConfig;
use Psr\Container\ContainerInterface;

return [
    DbConfig::class => static function (ContainerInterface $c) {
        return new DbConfig(
            $c->get('config')['db']['dsn']
        );
    },

    'config' => [
        'db' => [
            'dsn' => 'sqlite:../db/database.db'
        ],
    ]
];
