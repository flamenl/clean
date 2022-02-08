<?php

namespace Application\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SomeHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new JsonResponse([
            'bob' => 'was here in ' . __CLASS__,
            'id' => $request->getAttribute('id', '0'),
        ]);

        return $response;
    }
}
