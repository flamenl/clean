<?php

declare(strict_types=1);

namespace Application\Service;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;

class ViewPage
{

    private bool $show = true;

    private string $title = '';

    public function setShow(bool $show): void
    {
        $this->show = $show;
    }

    public function show(): bool
    {
        return $this->show;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function render(HtmlResponse|ResponseInterface $response): HtmlResponse
    {
        if ($response instanceof HtmlResponse) {
            /** @var HtmlResponse $response */
            $view = new View();
            $vars = [
                'title' => $this->title,
                'content' => (string) $response->getBody()
            ];
            $content = $view->render('application/page.phtml', $vars);
            $response = new HtmlResponse($content, $response->getStatusCode(), $response->getHeaders());
        }
        return $response;
    }
}
