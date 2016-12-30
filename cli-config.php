<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . '/vendor/autoload.php';

// Dotenv setup
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$settings = require __DIR__ . '/app/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/app/dependencies.php';

return ConsoleRunner::createHelperSet($container->get('em'));
