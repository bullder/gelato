<?php
declare(strict_types=1);

use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return static function (App $app) {
    $app->add(SessionMiddleware::class);

    $app->add(TwigMiddleware::create(
        $app,
        Twig::create(
            __DIR__ . '/../src/templates/',
            ['cache' => __DIR__ . '/../var/cache/twig']
        )
    ));
};
