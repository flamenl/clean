<?php

namespace Application\ValueObject;

class RouterMatch
{
    private array|string $handler;

    private array $vars = [];

    private ?Route $route;

    public function __construct(array|string|Route $handler, array $vars = [])
    {
        if ($handler instanceof Route) {
            $this->route = $handler;
            $this->handler = $this->route->getHandler();
        } else {
            $this->handler = $handler;
        }
        $this->vars = $vars;
    }

    public function getHandler(): string|array
    {
        return $this->hasRoute() ? $this->getRoute()->getHandler() : $this->handler;
    }

    public function hasRoute(): bool
    {
        return $this->route instanceof Route;
    }

    public function getRoute(): Route|null
    {
        return $this->hasRoute() ? $this->route : null;
    }

    public function getVars(): array
    {
        return $this->vars;
    }
}
