<?php

declare(strict_types=1);

namespace Application\Service\Factory;

use Application\Service\Router;
use Application\ValueObject\Route;
use FastRoute\RouteCollector;
use Psr\Container\ContainerInterface;
use function FastRoute\simpleDispatcher;

class RouterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        /** @var Route[] $routes */
        $routes = $config['routes'] ?? [];

        $dispatcher = simpleDispatcher(function(RouteCollector $r) use ($routes)
        {
            foreach ($routes as $route) {
                $r->addRoute(
                    $route->getMethod(),
                    $route->getPath(),
                    $route // Pass the whole route as a handler...
                );
            }
        });

        return new Router($dispatcher);
    }


}
