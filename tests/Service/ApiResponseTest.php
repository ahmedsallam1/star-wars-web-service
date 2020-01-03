<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseTest extends KernelTestCase
{
    /**
     * @var App\Service\ApiResponse
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(ApiResponse::class)
        ;
    }

    /**
     * @test
     */
    public function test_set_response()
    {
        $this->service->setResponse(new Response());

        $this->assertInstanceOf(Response::class, $this->service->getResponse());
    }

    /**
     * @test
     */
    public function test_set_message()
    {
        $message = 'test';

        $this->service->setMessage($message);

        $this->assertEquals($message, $this->service->getMessage());
    }

    /**
     * @test
     */
    public function test_set_status_code()
    {
        $code = 200;

        $this->service->setStatusCode($code);

        $this->assertEquals($code, $this->service->getStatusCode());
    }

    /**
     * @test
     */
    public function test_set_error()
    {
        $error = 'error';

        $this->service->setError($error);

        $this->assertEquals($error, $this->service->getError());
    }


    /**
     * @test
     */
    public function test_set_data()
    {
        $data = [
            'id'=> 1,
            'title'=> 'test'
        ];

        $this->service->setData($data);

        $this->assertEquals($data, $this->service->getData(), "\$canonicalize = true", 0.0, 10, true);
    }

    /**
     * @test
     */
    public function test_to_json()
    {
        $response = $this->service->toJson();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertJson($this->service->toJson()->getContent());
    }
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}