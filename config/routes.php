<?php

use Slim\App;
use App\Middleware\AuthMiddleware;
use App\Middleware\ReAuthMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    $app->group('/auth', function (RouteCollectorProxy $group) {
        $group->any('/login', \App\Controllers\MainController::class . ':login')->add(new ReAuthMiddleware());
        $group->any('/logout', \App\Controllers\MainController::class . ':logout');
    });
    $app->group('', function (RouteCollectorProxy $group) {
        $group->post('/add', \App\Controllers\MainController::class . ':add');
        $group->get('/edit/{id}', \App\Controllers\MainController::class . ':edit');
        $group->get('/', 'App\Controllers\MainController:index');
    })->add(new AuthMiddleware());
};
