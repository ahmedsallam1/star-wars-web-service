<?php
namespace App\Tests\Service;

use App\Document\People;
use App\Service\CharacterService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CharacterServiceTest
 * @package App\Tests\Service
 */
class CharacterServiceTest extends KernelTestCase
{
    /**
     * @var CharacterService
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(CharacterService::class)
        ;
    }

    /**
     * @test
     */
    public function testGetOneBy()
    {
        $people = $this->service->getBy(['isMostAppeared' => true]);

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
