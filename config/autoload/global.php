<?php

declare(strict_types=1);

use Application\Handler\Factory\SomeHandlerFactory;
use Application\Handler\SomeHandler;
use Application\Lib\App;
use Application\Lib\Factory\AppFactory;
use Application\Middleware\Factory\RouterMiddlewareFactory;
use Application\Middleware\RouterMiddleware;
use Application\Service\Emitter;
use Application\Service\Factory\DispatcherFactory;
use Application\Service\Factory\MiddlewareFactoryFactory;
use Application\Service\Factory\RouterFactory;
use Application\Service\Factory\ServerRequestFactory;
use Application\Service\MiddlewareFactory;
use Application\Service\Router;
use Application\ValueObject\Route;
use Fig\EventDispatcher\AggregateProvider;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ServerRequestInterface;

return [
    'dependencies' => [
        'aliases' => [
        ],
        'invokables' => [
            AggregateProvider::class => AggregateProvider::class,
            Emitter::class => Emitter::class,
        ],
        'factories' => [
            App::class => AppFactory::class,
            ServerRequestInterface::class => ServerRequestFactory::class,

            // Handlers
            SomeHandler::class => SomeHandlerFactory::class,

            // Services
            EventDispatcherInterface::class => DispatcherFactory::class,
            Router::class => RouterFactory::class,
            MiddlewareFactory::class => MiddlewareFactoryFactory::class,

            // Middleware
            RouterMiddleware::class => RouterMiddlewareFactory::class,
        ],
    ],
    'pipes' => [
        // Middleware that always is included
        RouterMiddleware::class,
    ],
    'routes' => [
        new Route('GET', '/', SomeHandler::class),
        new Route('GET', '/aap', SomeHandler::class),
        new Route('GET', '/noot', SomeHandler::class),
        new Route('GET', '/mies/{id:\d+}', SomeHandler::class),
    ]
];
