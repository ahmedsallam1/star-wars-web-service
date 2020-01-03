<?php
namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\PeopleRepository;
use Doctrine\ODM\MongoDB\Query\Query;

/**
 * Class PeopleRepositoryTest
 * @package App\Tests\Repository
 */
class PeopleRepositoryTest extends KernelTestCase
{
    /**
     * @var PeopleRepository
     */
    private $repository;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->repository = $kernel->getContainer()
            ->get(PeopleRepository::class)
        ;
    }

    /**
     * @test
     */
    public function testFindBy()
    {
        $people = $this->repository->findBy(['isMostAppeared']);

        $this->assertInstanceOf(Query::class, $people);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
