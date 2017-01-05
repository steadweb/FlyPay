<?php

namespace Steadweb\Flypay\Middlewares\Validation;

use Slim\Http\Request;
use Slim\Http\Response;

class IsBase64Validation
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return bool
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $public_key = $request->getParam('public_key', false);

        if(base64_decode($public_key, true) === false) {
            return $response->withStatus(400)->withJson([
                'message' => "Public key must be encoded base64 encoded."
            ]);
        }

        return $next($request, $response);
    }
}