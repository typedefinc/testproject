<?php

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

define('APP_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(require __DIR__ . '/../config/dependencies.php');

$container = $containerBuilder->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$middlewear = require __DIR__ . '/../config/middleware.php';
$middlewear($app);

$route = require __DIR__ . '/../config/routes.php';
$route($app);

$app->run();
