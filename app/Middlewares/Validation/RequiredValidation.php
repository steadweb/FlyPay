<?php declare(strict_types=1);

namespace Steadweb\Flypay\Middlewares\Validation;

use Slim\Http\Request;
use Slim\Http\Response;

class RequiredValidation
{
    /**
     * @var array
     */
    private $required = [];

    /**
     * RequriedValidation middleware.
     *
     * @param array $required
     */
    public function __construct(array $required)
    {
        $this->required = $required;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return bool
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        // Assume the data passed is invalid, until proven otherwise.
        $missing = true;
        $body = $request->getParsedBody();

        if($body) {
            $missing = array_diff($this->required, array_keys($body));
        }

        if($missing) {
            return $response->withStatus(400, 'Missing required params')->withJson([
                'message' => "This request is missing the following data",
                'param' => array_values($missing)
            ]);
        }

        return $next($request, $response);
    }
}
