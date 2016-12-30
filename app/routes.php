<?php declare(strict_types=1);

$app->get('/cards', 'Steadweb\Flypay\Actions\CardAction:all');
$app->post('/cards', 'Steadweb\Flypay\Actions\CardAction:create')
    ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
        'last4',
        'type'
    ])
);

$app->get('/locations', 'Steadweb\Flypay\Actions\LocationAction:all');
$app->post('/locations', 'Steadweb\Flypay\Actions\LocationAction:create')
    ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
        'title'
    ])
);

$app->get('/payments', 'Steadweb\Flypay\Actions\PaymentAction:all');
$app->post('/payments', 'Steadweb\Flypay\Actions\PaymentAction:create')
    ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
        'amount',
        'table',
        'location',
        'reference',
        'card'
    ])
);

$app->get('/tables', 'Steadweb\Flypay\Actions\TableAction:all');
$app->post('/tables', 'Steadweb\Flypay\Actions\TableAction:create')
    ->add(new \Steadweb\Flypay\Middlewares\Validation\RequiredValidation([
        'seats'
    ])
);
