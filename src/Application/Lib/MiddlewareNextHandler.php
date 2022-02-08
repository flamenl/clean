<?php

declare(strict_types=1);

namespace Application\Lib;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareNextHandler implements RequestHandlerInterface
{
    /**
     * Processes all middlewares until a handler is reached.
     * @var array of type MiddlewareInterface or RequestHandlerInterface
     */
    private array $stack = [];

    public function __construct(array $stack)
    {
        $valid = false;
        foreach ($stack as $item) {
            if ($item instanceof MiddlewareInterface) {
                continue;
            }
            if ($item instanceof RequestHandlerInterface) {
                $valid = true;
                break;
            }
            throw new \Exception('The stack should have only middlewares and a requesthandler.');
        }
        if ($valid === false) {
            throw new \Exception('No Request handler found.');
        }
        $this->stack = $stack;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $item = array_shift($this->stack);
        if ($item instanceof MiddlewareInterface) {
            $handler = new MiddlewareNextHandler($this->stack);
            return $item->process($request, $handler);
        }
        if ($item instanceof RequestHandlerInterface === false) {
            throw new \Exception('No Request handler found.');
        }
        return $item->handle($request);
    }

}
