<?php

declare(strict_types=1);

namespace Application\Service\Factory;

use Application\Service\MiddlewareFactory;
use Psr\Container\ContainerInterface;

class MiddlewareFactoryFactory
{

    public function __invoke(ContainerInterface $container): MiddlewareFactory
    {
        return new MiddlewareFactory($container);
    }
}
