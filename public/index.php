<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Dotenv setup
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
include __DIR__ . '/../app/dependencies.php';

// Register middleware
include __DIR__ . '/../app/middleware.php';

// Register routes
include __DIR__ . '/../app/routes.php';

// Run app
$app->run();
