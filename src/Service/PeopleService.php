<?php
namespace App\Service;

use App\Repository\PeopleRepository;

/**
 * Class PeopleService
 * @package App\Service
 */
final class PeopleService
{
    /**
     * @var PeopleRepository
     */
    private $repository;

    /**
     * @param PeopleRepository $peopleRepository
     */
    public function __construct(PeopleRepository $peopleRepository)
    {
        $this->repository = $peopleRepository;
    }

    /**
     * @param array $criteria
     * @return array|\Doctrine\ODM\MongoDB\Iterator\Iterator|int|\MongoDB\DeleteResult|\MongoDB\InsertOneResult|\MongoDB\UpdateResult|null|object
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function getBy(array $criteria = [])
    {
        return $this->repository->findBy($criteria)->execute();
    }
}
