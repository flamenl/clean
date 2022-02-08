<?php

declare(strict_types=1);

namespace Application\Service\Factory;

use Laminas\Diactoros\ServerRequestFactory as DiactorosServerRequestFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestFactory
{
    public function __invoke(ContainerInterface $container): ServerRequestInterface
    {
        return DiactorosServerRequestFactory::fromGlobals();
    }
}
