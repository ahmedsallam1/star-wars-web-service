<?php
namespace App\Service;

use App\Repository\SpeciesRepository;

/**
 * Class SpeciesService
 * @package App\Service
 */
final class SpeciesService
{
    /**
     * @var PeopleRepository
     */
    private $repository;

    /**
     * @param SpeciesRepository $speciesRepository
     */
    public function __construct(SpeciesRepository $speciesRepository)
    {
        $this->repository = $speciesRepository;
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
