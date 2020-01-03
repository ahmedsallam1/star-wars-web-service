<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\FilmService;

/**
 * Class FilmServiceTest
 * @package App\Tests\Repository
 */
class FilmServiceTest extends KernelTestCase
{
    /**
     * @var FilmService
     */
    private $service;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->service = $kernel->getContainer()
            ->get(FilmService::class)
        ;
    }

    /**
     * @test
     */
    public function testGetOneBy()
    {
        $film = $this->service->getOneBy(['longest' => 'title']);

        $this->assertTrue(is_array($film));
        $this->assertTrue(!empty($film));
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
