<?php

namespace Steadweb\Flypay\Tests;

use Slim\Http\Body;

class MockRequestBody extends Body
{
    public function __construct(array $data)
    {
        $stream = fopen('php://temp', 'w+');
        fwrite($stream, json_encode($data), strlen(json_encode($data)));
        rewind($stream);

        parent::__construct($stream);
    }
}