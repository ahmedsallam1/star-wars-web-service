<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Factory\HttpResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class HttpResponseFactoryTest extends KernelTestCase
{
    /**
     * @var HttpResponseFactory
     */
    private $factory;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->factory = $kernel->getContainer()
            ->get(HttpResponseFactory::class)
        ;
    }

    /**
     * @test
     */
    public function testCreate()
    {
        $factory = $this->factory::create();

        $this->assertInstanceOf(Response::class, $factory);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
