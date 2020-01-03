<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiResponseTest
 * @package App\Tests\Repository
 */
class ApiResponseTest extends KernelTestCase
{
    /**
     * @var ApiResponse
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
    public function testSetResponse()
    {
        $this->service->setResponse(new Response());

        $this->assertInstanceOf(Response::class, $this->service->getResponse());
    }

    /**
     * @test
     */
    public function testSetMessage()
    {
        $message = 'test';

        $this->service->setMessage($message);

        $this->assertEquals($message, $this->service->getMessage());
    }

    /**
     * @test
     */
    public function testSetStatusCode()
    {
        $code = 200;

        $this->service->setStatusCode($code);

        $this->assertEquals($code, $this->service->getStatusCode());
    }

    /**
     * @test
     */
    public function testSetError()
    {
        $error = 'error';

        $this->service->setError($error);

        $this->assertEquals($error, $this->service->getError());
    }


    /**
     * @test
     */
    public function testSetData()
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
    public function testToJson()
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
