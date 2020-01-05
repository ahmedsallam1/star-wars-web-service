<?php
namespace App\Repository;

use App\Document\Species;
use Doctrine\ODM\MongoDB\Aggregation\Builder as AggregationBuilder;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Query\Query;

/**
 * Class SpeciesRepository
 * @package App\Repository
 */
final class SpeciesRepository
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
        $this->repository = $documentManager->getRepository(Species::class);
    }

    /**
     * Query the db using criteria
     *
     * @param array $criteria
     *
     * @return Query
     */
    public function findBy(array $criteria = []) : AggregationBuilder
    {
        $aggregationBuilder = $this->repository->createAggregationBuilder();

        foreach ($criteria as $key => $value) {
            if (method_exists($this, 'scope'.$key)) {
                $aggregationBuilder = $this->{'scope'.$key}($aggregationBuilder, $value);
            }
        }

        return $aggregationBuilder;
    }

    /**
     * add where `id` field in array of ids
     *
     * @param AggregationBuilder $aggregationBuilder
     * @param  array $ids
     *
     * @return AggregationBuilder
     */
    private function scopeId(AggregationBuilder $aggregationBuilder, array $ids) : AggregationBuilder
    {
        $aggregationBuilder
            ->match()
            ->field('id')
            ->in($ids)
        ;

        return $aggregationBuilder;
    }

    /**
     * select size of specific field
     *
     * @param AggregationBuilder $aggregationBuilder
     * @param  string $field
     *
     * @return AggregationBuilder
     */
    private function scopeGetSizeOf(AggregationBuilder $aggregationBuilder, string $field) : AggregationBuilder
    {
        $aggregationBuilder
            ->project()
            ->field($field."Count")
            ->expression($aggregationBuilder->expr()->size("$$field"))
            ->field('name')
            ->expression('$name')
        ;

        return $aggregationBuilder;
    }
}
