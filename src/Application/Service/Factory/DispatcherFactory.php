<?php

declare(strict_types=1);

namespace Application\Service\Factory;

use Crell\Tukio\Dispatcher;
use Fig\EventDispatcher\AggregateProvider;
use Psr\Container\ContainerInterface;

class DispatcherFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var AggregateProvider $aggregatedProvider */
        $aggregatedProvider = $container->get(AggregateProvider::class);

        // @TODO: this could be a convenient spot to add your providers.
        // $aggregatedProvider->addProvider($container->get(CustomProvider::class));

        return new Dispatcher($aggregatedProvider);
    }

}
