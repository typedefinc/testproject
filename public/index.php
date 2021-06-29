<?php

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

$container = $containerBuilder->build();

AppFactory::setContainer($container);

$settings = require __DIR__ . '/../app/settings.php';
$settings($container);

$app = AppFactory::create();

$middlewear = require __DIR__ . '/../app/middlewear.php';
$middlewear($app);

$route = require __DIR__ . '/../app/routes.php';
$route($app);

$app->run();
