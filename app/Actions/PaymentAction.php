<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Resources\PaymentResource;
use Psr\Log\LoggerInterface;

final class PaymentAction
{
    /**
     * @var PaymentResource
     */
    private $paymentResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PaymentAction constructor.
     *
     * @param PaymentResource $paymentResource
     */
    public function __construct(
        PaymentResource $paymentResource,
        LoggerInterface $logger
    )
    {
        $this->paymentResource = $paymentResource;
        $this->logger = $logger;
    }

    /**
     * Get all the Payments.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function all(Request $request, Response $response)
    {
        return $response->withJson($this->paymentResource->all());
    }

    /**
     * Create a payment.
     *
     * @param Request $request
     * @param Response $response
     */
    public function create(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $this->paymentResource->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create payment.');
        }

        return $response->withStatus(201, 'Payment created.');
    }
}
