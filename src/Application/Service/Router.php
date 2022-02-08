<?php

declare(strict_types=1);

namespace Application\Service;

use Application\ValueObject\RouterMatch;
use Psr\Http\Message\RequestInterface;

class Router
{
    private $dispatcher;

    private ?RouterMatch $routerMatch = null;

    /**
     * @param $dispatcher
     */
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function getRouteMatch(RequestInterface $request): RouterMatch
    {
        if (!$this->routerMatch) {
            $method = $request->getMethod();
            $path = $request->getUri()->getPath();
            $routeInfo = $this->dispatcher->dispatch($method, $path);

            if ($routeInfo[0] === \FastRoute\Dispatcher::NOT_FOUND) {
                throw new \Exception('Not Found', 404);
            }

            if ($routeInfo[0] === \FastRoute\Dispatcher::METHOD_NOT_ALLOWED) {
                throw new \Exception('Method Not Allowed', 405);
            }

            if ($routeInfo[0] !== \FastRoute\Dispatcher::FOUND) {
                throw new \Exception('Bad Request', 400);
            }

            $this->routerMatch = new RouterMatch($routeInfo[1], $routeInfo[2]);
        }
        return $this->routerMatch;
    }
}
