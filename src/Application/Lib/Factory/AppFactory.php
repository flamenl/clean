<?php

declare(strict_types=1);

namespace Application\Lib\Factory;

use Application\Lib\App;
use Application\Service\MiddlewareFactory;
use Application\Service\Router;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class AppFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new App(
            $container->get('config'),
            $container->get(Router::class),
            $container->get(MiddlewareFactory::class),
            $container->get(EventDispatcherInterface::class),
        );
    }
}
