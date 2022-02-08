<?php

declare(strict_types=1);

use Application\Lib\App;
use Application\Service\Container;
use Application\Service\Emitter;
use Psr\Http\Message\ServerRequestInterface;

require '../vendor/autoload.php';

(function () {
    /** @var array $config */
    $config = require '../config/config.php';
    $container = new Container($config['dependencies'] ?? []);
    $container->set('config', $config);

    /** @var ServerRequestInterface $request */
    $request  = $container->get(ServerRequestInterface::class);

    /** @var Emitter $emitter */
    $emitter = $container->get(Emitter::class);

    /** @var App $app */
    $app = $container->get(App::class);

    $response = $app->handle($request);
    $emitter->emit($response);
})();
