<?php declare(strict_types=1);

namespace Steadweb\Flypay\Middlewares;

use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;

final class Authentication
{
    /**
     * Check the token exists within the header and whether it's valid.
     *
     * @param Request $request
     * @param Response $response
     * @param $next
     *
     * @return bool
     *
     * @throws \Error
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $token = current($request->getHeader('token'));

        try {
            if(!$token) {
            }

            // For the moment, use our generated key pair to validate.
            $public_key = openssl_pkey_get_public('file://' . __DIR__ . '/../../public.pem');
            JWT::decode($token, $public_key, ['RS256']);
        } catch(\Exception $e) {
            return $response->withStatus(401);
        }

        return $next($request, $response);
    }
}