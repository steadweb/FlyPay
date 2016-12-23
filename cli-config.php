<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . '/vendor/autoload.php';

$settings = require __DIR__ . '/app/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/app/dependencies.php';

return ConsoleRunner::createHelperSet($container->get('em'));