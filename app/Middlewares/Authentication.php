<?php declare(strict_types=1);

namespace Steadweb\Flypay\Middlewares;

use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\ClientRepository;

final class Authentication
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * Authentication Middleware.
     *
     * @var ClientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Check the token exists within the header and whether it's valid.
     * We expect clients to register a key pair, by generating a
     * private/public key. Each time they send data to our API, they must
     * sign if with their private key. We will auth with their public key.
     *
     * @param Request $request
     * @param Response $response
     * @param $next
     *
     * @return bool
     *
     * @throws \Error
     */
    public function auth(Request $request, Response $response, $next)
    {
        $token = current($request->getHeader('token'));

        try {
            // Basic check to see if the token has been passed within the
            // request headers.
            if(!$token) {
                throw new \Error("Token missing within headers");
            }

            // Fetch the key based on REMOTE_ADDR (i.e. the domain).
            // If not found, we throw an error, internally.
            // If the public key fails, an error is thrown.
            $domain = $request->getServerParam('REMOTE_ADDR');
            $client = $this->clientRepository->findByDomain($domain);
            $public_key = openssl_pkey_get_public($client->getPublicKey());

            // If decoding the token against the public key, an error will
            // be thrown.
            JWT::decode($token, $public_key, ['RS256']);
        } catch(\Error $e) {
            return $response->withStatus(401);
        }

        return $next($request, $response);
    }
}
