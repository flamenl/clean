<?php

declare(strict_types=1);

namespace Application\ValueObject;

class Route
{
    public function __construct(
        private string $method,
        private string $path,
        private string|array $handler,
        private ?string $routeName = '',
        private ?array $middleware = null
    )
    {}

    public function getMethod(): string
    {
        return strtoupper($this->method);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getHandler(): array|string
    {
        return $this->handler;
    }

    public function getRouteName(): string
    {
        return $this->routeName;
    }

    public function getMiddleware(): ?array
    {
        return $this->middleware;
    }
}
