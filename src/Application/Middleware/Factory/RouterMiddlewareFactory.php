<?php

declare(strict_types=1);

namespace Application\Middleware\Factory;

use Application\Middleware\RouterMiddleware;
use Application\Service\Router;
use Psr\Container\ContainerInterface;

class RouterMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Router $router */
        $router = $container->get(Router::class);
        return new RouterMiddleware($router);
    }
}
