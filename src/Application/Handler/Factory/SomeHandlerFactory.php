<?php

declare(strict_types=1);

namespace Application\Handler\Factory;

use Application\Handler\SomeHandler;
use Psr\Container\ContainerInterface;

class SomeHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SomeHandler();
    }

}
