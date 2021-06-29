<?php

use Slim\App;
use App\Controllers\MainController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    $app->post('/add', \App\Controllers\MainController::class . ':addAction');

    $app->get('/edit/{id}', \App\Controllers\MainController::class . ':editAction');

    $app->get('/login', \App\Controllers\MainController::class . ':loginAction');

    $app->get('/', 'App\Controllers\MainController:indexAction');
};
