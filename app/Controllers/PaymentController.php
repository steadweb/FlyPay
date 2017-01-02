<?php declare(strict_types=1);

namespace Steadweb\Flypay\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\PaymentRepository;
use Psr\Log\LoggerInterface;

final class PaymentController
{
    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PaymentController constructor.
     *
     * @param PaymentRepository $paymentRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        PaymentRepository $paymentRepository,
        LoggerInterface $logger
    )
    {
        $this->paymentRepository = $paymentRepository;
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
        return $response->withJson($this->paymentRepository->all());
    }

    /**
     * Create a payment.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function create(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $payment = $this->paymentRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create payment.');
        }

        return $response->withStatus(201, 'Payment created.')->withJson([
            'id' => $payment->getId()
        ]);
    }

    public function report(Request $request, Response $response)
    {
        $location = $request->getQueryParam('location', null);
        return $response->withJson($this->paymentRepository->getLast24HoursByLocation($location));
    }
}
