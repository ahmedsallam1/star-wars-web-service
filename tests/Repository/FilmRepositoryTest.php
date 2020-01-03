<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\FilmRepository;
use Doctrine\ODM\MongoDB\Aggregation\Builder as AggregationBuilder;

class FilmRepositoryTest extends KernelTestCase
{
    /**
     * @var FilmRepository
     */
    private $repository;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->repository = $kernel->getContainer()
            ->get(FilmRepository::class)
        ;
    }

    /**
     * @test
     */
    public function testFindOneBy()
    {
        $film = $this->repository->findOneBy(['longest' => 'title']);

        $this->assertInstanceOf(AggregationBuilder::class, $film);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
