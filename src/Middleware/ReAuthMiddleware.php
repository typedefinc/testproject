<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ReAuthMiddleware implements MiddlewareInterface
{
    private $storage;

    public function __construct()
    {
        session_start();
        $this->storage = $_SESSION;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        var_dump($this->storage['logged']);
        if ($this->storage['logged'] == true) {
            return $handler->handle($request)->withHeader('Location', '/');
        }
        return $handler->handle($request);
    }
}
