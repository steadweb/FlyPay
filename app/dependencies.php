<?php declare(strict_types=1);

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

$container['Steadweb\Flypay\Actions\CardAction'] = function($c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Card');
    $respository = new \Steadweb\Flypay\Repositories\CardRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\CardAction($respository, $c->get('logger'));
};

// Clients
$container['Steadweb\Flypay\Entities\Client'] = function($c) {
    return new Steadweb\Flypay\Entities\Client();
};

$container['Steadweb\Flypay\Repositories\ClientRepository'] = function($c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Client');
    return new \Steadweb\Flypay\Repositories\ClientRepository($c->get('em'), $entity);
};

$container['Steadweb\Flypay\Actions\ClientAction'] = function($c) {
    $respository = $c->get('Steadweb\Flypay\Repositories\ClientRepository');
    return new \Steadweb\Flypay\Actions\ClientAction($respository, $c->get('logger'));
};

// Locations
$container['Steadweb\Flypay\Entities\Location'] = function($c) {
    return new Steadweb\Flypay\Entities\Location();
};

$container['Steadweb\Flypay\Actions\LocationAction'] = function($c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Location');
    $respository = new \Steadweb\Flypay\Repositories\LocationRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\LocationAction($respository, $c->get('logger'));
};

// Payments
$container['Steadweb\Flypay\Entities\Payment'] = function($c) {
    return new Steadweb\Flypay\Entities\Payment();
};

$container['Steadweb\Flypay\Actions\PaymentAction'] = function($c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Payment');
    $respository = new \Steadweb\Flypay\Repositories\PaymentRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\PaymentAction($respository, $c->get('logger'));
};

// Tables
$container['Steadweb\Flypay\Entities\Table'] = function($c) {
    return new Steadweb\Flypay\Entities\Table();
};

$container['Steadweb\Flypay\Actions\TableAction'] = function($c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Table');
    $respository = new \Steadweb\Flypay\Repositories\TableRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\TableAction($respository, $c->get('logger'));
};

// Middleswares
$container['Steadweb\Flypay\Middlewares\Authentication'] = function ($c) {
    return new Steadweb\Flypay\Middlewares\Authentication($c->get('Steadweb\Flypay\Repositories\ClientRepository'));
};
