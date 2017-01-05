<?php declare(strict_types=1);

$app->group('/client/', function() use ($app) {
    $app->post('register', 'Steadweb\Flypay\Controllers\ClientController:register')
        ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
            'domain',
            'public_key'
        ]))
        ->add(new \Steadweb\Flypay\Middlewares\Validation\IsBase64Validation());
});

$app->group('/api/v1/', function() use ($app) {
    $app->get('cards', 'Steadweb\Flypay\Controllers\CardController:all');
    $app->post('cards', 'Steadweb\Flypay\Controllers\CardController:create')
        ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
            'last4',
            'type'
        ])
    );

    $app->get('locations', 'Steadweb\Flypay\Controllers\LocationController:all');
    $app->post('locations', 'Steadweb\Flypay\Controllers\LocationController:create')
        ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
            'title'
        ])
    );

    $app->get('payments', 'Steadweb\Flypay\Controllers\PaymentController:all');
    $app->post('payments', 'Steadweb\Flypay\Controllers\PaymentController:create')
        ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
            'amount',
            'table',
            'location',
            'reference',
            'card'
        ])
    );

    $app->get('tables', 'Steadweb\Flypay\Controllers\TableController:all');
    $app->post('tables', 'Steadweb\Flypay\Controllers\TableController:create')
        ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
            'seats'
        ])
    );

    $app->get('report', 'Steadweb\Flypay\Controllers\PaymentController:report');
})->add('Steadweb\Flypay\Middlewares\Authentication:auth');
