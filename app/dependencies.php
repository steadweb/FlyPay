<?php declare(strict_types=1);

use Steadweb\Flypay\Entities\Card;
use Steadweb\Flypay\Entities\Client;
use Steadweb\Flypay\Entities\Location;
use Steadweb\Flypay\Entities\Payment;
use Steadweb\Flypay\Entities\Table;

$container = $app->getContainer();

// Doctrine
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// Logging
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Cards
$container['Steadweb\Flypay\Entities\Card'] = function($c) {
    return new Steadweb\Flypay\Entities\Card();
};

$container['Steadweb\Flypay\Controllers\CardController'] = function($c) {
    return new \Steadweb\Flypay\Controllers\CardController($c->get('em')->getRepository(Card::class), $c->get('logger'));
};

// Clients
$container['Steadweb\Flypay\Entities\Client'] = function($c) {
    return new Steadweb\Flypay\Entities\Client();
};

$container['Steadweb\Flypay\Controllers\ClientController'] = function($c) {
    return new \Steadweb\Flypay\Controllers\ClientController($c->get('em')->getRepository(Client::class), $c->get('logger'));
};

// Locations
$container['Steadweb\Flypay\Entities\Location'] = function($c) {
    return new Steadweb\Flypay\Entities\Location();
};

$container['Steadweb\Flypay\Controllers\LocationController'] = function($c) {
    return new \Steadweb\Flypay\Controllers\LocationController($c->get('em')->getRepository(Location::class), $c->get('logger'));
};

// Payments
$container['Steadweb\Flypay\Entities\Payment'] = function($c) {
    return new Steadweb\Flypay\Entities\Payment();
};

$container['Steadweb\Flypay\Controllers\PaymentController'] = function($c) {
    return new \Steadweb\Flypay\Controllers\PaymentController($c->get('em')->getRepository(Payment::class), $c->get('logger'));
};

// Tables
$container['Steadweb\Flypay\Entities\Table'] = function($c) {
    return new Steadweb\Flypay\Entities\Table();
};

$container['Steadweb\Flypay\Controllers\TableController'] = function($c) {
    return new \Steadweb\Flypay\Controllers\TableController($c->get('em')->getRepository(Table::class), $c->get('logger'));
};

// Middleswares
$container['Steadweb\Flypay\Middlewares\Authentication'] = function ($c) {
    return new Steadweb\Flypay\Middlewares\Authentication($c->get('em')->getRepository(Client::class));
};
