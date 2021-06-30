<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private $storage;

    public function __construct()
    {
        session_start();
        $this->storage = $_SESSION;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!isset($this->storage['logged'])) {
            $this->storage['logged'] = false;
        }
        if ($this->storage['logged'] == false) {
            header('Location:/auth/login');
        }
        return $handler->handle($request);
    }
}
