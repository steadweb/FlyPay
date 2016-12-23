<?php declare(strict_types=1);

use \Steadweb\Flypay\Middlewares\Authentication as AuthenticationMiddleware;

$app->add(new AuthenticationMiddleware);