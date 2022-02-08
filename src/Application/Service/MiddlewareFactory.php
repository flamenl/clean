<?php

namespace Application\Service;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareFactory
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }

    public function get(string $id): MiddlewareInterface {
        $middleware = $this->container->get($id);
        if ($middleware instanceof MiddlewareInterface === false) {
            throw new \Exception('MiddlewareFactory get() may only retreive instances of MiddlewareInterface');
        }
        return $middleware;
    }

    public function getHandler(mixed $id): RequestHandlerInterface
    {
        $handler = $this->container->get($id);
        if ($handler instanceof RequestHandlerInterface === false) {
            throw new \Exception('MiddlewareFactory getHandler() may only retreive instances of RequestHandlerInterface');
        }
        return $handler;
    }
}
