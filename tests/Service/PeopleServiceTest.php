<?php
namespace App\Tests\Service;

use App\Document\People;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\PeopleService;

/**
 * Class PeopleServiceTest
 * @package App\Tests\Service
 */
class PeopleServiceTest extends KernelTestCase
{
    /**
     * @var PeopleService
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(PeopleService::class)
        ;
    }

    /**
     * @test
     */
    public function testGetOneBy()
    {
        $people = $this->service->getBy(['isMostAppeared' => true])->current();

        $this->assertInstanceOf(People::class, $people);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
