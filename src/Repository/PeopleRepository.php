<?php
namespace App\Repository;

use App\Document\People;
use Doctrine\ODM\MongoDB\Query\Builder as QueryBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Query\Query;

/**
 * Class PeopleRepository
 * @package App\Repository
 */
final class PeopleRepository
{
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->repository = $documentManager->getRepository(People::class);
    }

    /**
     * Query the db using criteria
     *
     * @param array $criteria
     *
     * @return Query
     */
    public function findBy(array $criteria = []) : Query
    {
        $queryBuilder = $this->repository->createQueryBuilder();

        foreach ($criteria as $key => $value) {
            if (method_exists($this, 'scope'.$key)) {
                $queryBuilder = $this->{'scope'.$key}($queryBuilder, $value);
            }
        }

        return $queryBuilder->getQuery();
    }

    /**
     * add where `id` field equals specific id
     * @param QueryBuilder $queryBuilder
     * @param  int $id
     *
     * @return QueryBuilder
     */
    private function scopeId(QueryBuilder $queryBuilder, int $id) : QueryBuilder
    {
        $queryBuilder
            ->field('id')
            ->equals($id)
        ;

        return $queryBuilder;
    }
}
