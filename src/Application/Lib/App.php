<?php

declare(strict_types=1);

namespace Application\Lib;

use Application\Event\SampleEvent;
use Application\Service\ViewPage;
use Application\Service\MiddlewareFactory;
use Application\Service\Router;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function __construct(
        private array $config,
        private Router $router,
        private MiddlewareFactory $middlewareFactory,
        private EventDispatcherInterface $dispatcher,
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->dispatcher->dispatch(new SampleEvent('Start of the application'));

        $pipes = $this->config['pipes'] ?? [];
        $stack = [];
        foreach ($pipes as $id) {
            $stack[] = $this->middlewareFactory->get($id);
        }
        $matchedRoute = $this->router->getRouteMatch($request);
        $stack[] = $this->middlewareFactory->getHandler($matchedRoute->getHandler());

        $handler = new MiddlewareNextHandler($stack);

        $response = $handler->handle($request);


        if ($response instanceof HtmlResponse) {
            $page = new ViewPage();
            $page->setTitle('The Clean Project');
            if ($page->show()) {
                $response = $page->render($response);
            }
        }

        $this->dispatcher->dispatch(new SampleEvent('End of the application'));

        return $response;
    }

}
