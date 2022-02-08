<?php

namespace Application\Handler;

use Application\Service\View;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SomeHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $view = new View();
        $content = $view->render('application/test.phtml', ['message' => 'Hello World!!!']);

        return new HtmlResponse($content);

        return new JsonResponse([
            'id' => $request->getAttribute('id', '0'),
            'html' => $content,
        ]);
    }
}
