<?php

declare(strict_types=1);

namespace Application\Service;

use Psr\Http\Message\ResponseInterface;

class Emitter
{
    public function emit(ResponseInterface $response) {

        foreach ($response->getHeaders() as $name => $values) {
            $headerName = ucwords($name, '-');
            $replaceExistingHeaders = $headerName !== 'Set-Cookie';
            foreach ($values as $value) {
                header(sprintf('%s: %s', $headerName, $value), $replaceExistingHeaders, $response->getStatusCode());
            }
        }

        header(sprintf(
            'HTTP/%s %d%s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            ($response->getReasonPhrase() ? ' ' . $response->getReasonPhrase() : '')
        ), true, $response->getStatusCode());

        echo $response->getBody();
    }
}
