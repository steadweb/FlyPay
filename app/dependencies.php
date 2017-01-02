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

$container['Steadweb\Flypay\Actions\CardAction'] = function(\Slim\Container $c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Card');
    $resource = new \Steadweb\Flypay\Repositories\CardRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\CardAction($resource, $c->get('logger'));
};

// Locations
$container['Steadweb\Flypay\Entities\Location'] = function($c) {
    return new Steadweb\Flypay\Entities\Location();
};

$container['Steadweb\Flypay\Actions\LocationAction'] = function(\Slim\Container $c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Location');
    $resource = new \Steadweb\Flypay\Repositories\LocationRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\LocationAction($resource, $c->get('logger'));
};

// Payments
$container['Steadweb\Flypay\Entities\Payment'] = function($c) {
    return new Steadweb\Flypay\Entities\Payment();
};

$container['Steadweb\Flypay\Actions\PaymentAction'] = function(\Slim\Container $c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Payment');
    $resource = new \Steadweb\Flypay\Repositories\PaymentRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\PaymentAction($resource, $c->get('logger'));
};

// Tables
$container['Steadweb\Flypay\Entities\Table'] = function($c) {
    return new Steadweb\Flypay\Entities\Table();
};

$container['Steadweb\Flypay\Actions\TableAction'] = function(\Slim\Container $c) {
    $entity = $c->get('Steadweb\Flypay\Entities\Table');
    $resource = new \Steadweb\Flypay\Repositories\TableRepository($c->get('em'), $entity);
    return new \Steadweb\Flypay\Actions\TableAction($resource, $c->get('logger'));
};
