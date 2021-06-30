<?php

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return [
    LoggerInterface::class => static function (ContainerInterface $c) {
        $config = $c->get('config')['logger'];

        $logger = new Logger('baseLogger');
        $handler = new StreamHandler($config['filepath']);

        $logger->pushHandler($handler);
        return $logger;
    },

    'config' => [
        'logger' => [
            'filepath' => '../logs/app.log',
        ]
    ],
];
