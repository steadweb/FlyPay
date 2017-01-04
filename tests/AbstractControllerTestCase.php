<?php

namespace Steadweb\Flypay\Tests;

use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Container;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Uri;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Middlewares\Validation\RequiredValidation;

abstract class AbstractControllerTestCase extends \PHPUnit_Framework_TestCase
{
    abstract protected function mockEntity(): AbstractEntity;
    abstract protected function runMockedSlimApp(array $data, AbstractEntity $abstractEntity): Response;

    /**
     * Return a mocked Enviroment object.
     *
     * @param string $method
     * @param string $request_uri
     *
     * @return Environment
     */
    protected function mockEnvironment(string $method = 'GET', string $request_uri = '/')
    {
        return Environment::mock([
            'REQUEST_METHOD' => $method,
            'REQUEST_URI' => $request_uri
        ]);
    }

    /**
     * Return a mocked response.
     *
     * @return Response
     */
    protected function mockResponse()
    {
        return new Response();
    }

    /**
     * Return a mocked logger.
     *
     * @return LoggerInterface
     */
    protected function mockLogger()
    {
        return \Mockery::mock('Psr\Log\LoggerInterface')->makePartial();
    }


    /**
     * Return a mocked repository.
     *
     * @param $class
     * @param $receive
     * @param $return
     * @return AbstractRepository
     */
    protected function mockRepository($class, $receive, $return)
    {
        $mock = \Mockery::mock($class)
            ->makePartial()
            ->shouldReceive($receive)
            ->andReturn($return)
            ->getMock();

        return $mock;
    }

    /**
     * Runs a slim app with mocked dependencies.
     *
     * @param string $controllerClass
     * @param string $method
     * @param string $repositoryClass
     * @param array $data
     * @param AbstractRepository $repo
     * @param array $requiredParams
     *
     * @return Response
     */
    protected function buildSlimAppAndReturnResponse(
        string $controllerClass,
        string $method,
        string $repositoryClass,
        array $data,
        AbstractRepository $repo,
        array $requiredParams = []
    ): Response
    {
        $requestBody = new MockRequestBody($data);
        $request = new Request(
            'POST',
            new Uri('http://', 'localhost', 80, '/foo'),
            new Headers([
                'Content-Type' => 'application/json'
            ]),
            [],
            [],
            $requestBody,
            []
        );

        $container = new Container();
        $container['request'] = $request;
        $container['response'] = $this->mockResponse();
        $container[$repositoryClass] = $repo;
        $container[$controllerClass] = function(Container $c) use($controllerClass, $repositoryClass) {
            $class = $controllerClass;
            return new $class($c->get($repositoryClass), $this->mockLogger());
        };

        $app = new App($container);
        $app->post('/foo', $controllerClass.':'.$method)->add(new RequiredValidation($requiredParams));

        $response = $app->run(true);

        return $response;
    }
}