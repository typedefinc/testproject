<?php

use App\Models\DbConfig;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'dbConfig' => [
            'dsn' => 'sqlite:../db/database.db'
        ],
        DbConfig::class => function (ContainerInterface $c) {
            return new DbConfig(
                $c->get('dbConfig')['dsn']
            );
        },
        'logger' => function () {
            $logger = new Logger('baseLogger');
            $handler = new StreamHandler('../logs/app.log');
            $logger->pushHandler($handler);
            return $logger;
        }
    ]);
};
