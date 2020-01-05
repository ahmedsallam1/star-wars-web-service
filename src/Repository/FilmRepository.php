<?php
namespace App\Repository;

use Doctrine\ODM\MongoDB\Aggregation\Builder as AggregationBuilder;
use App\Document\Film;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Class FilmRepository
 * @package App\Repository
 */
final class FilmRepository
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
        $this->repository = $documentManager->getRepository(Film::class);
    }

    /**
     * Query the db using criteria
     *
     * @param array $criteria
     *
     * @return AggregationBuilder
     */
    public function findOneBy(array $criteria = []) : AggregationBuilder
    {
        $aggregationBuilder = $this->repository->createAggregationBuilder();

        foreach ($criteria as $key => $value) {
            if (method_exists($this, 'scope'.$key)) {
                $aggregationBuilder = $this->{'scope'.$key}($aggregationBuilder, $value);
            }
        }

         $aggregationBuilder
             ->project()
             ->includeFields(['title', 'characters'])
         ;

        return $aggregationBuilder;
    }

    /**
     * Add sort by specific field descendingly
     *
     * @param AggregationBuilder $aggregationBuilder
     * @param string $field
     *
     * @return AggregationBuilder
     */
    private function scopeLongest(AggregationBuilder $aggregationBuilder, string $field) : AggregationBuilder
    {
        $aggregationBuilder
            ->project()
            ->includeFields(['title'])
            ->field($field."Length")
            ->expression($aggregationBuilder->expr()->strLenBytes("$$field"))
            ->sort($field."Length", 'desc')
        ;

        return $aggregationBuilder;
    }

    /**
     * Add sort by specific field descendingly
     *
     * @param AggregationBuilder $aggregationBuilder
     * @param string $field
     *
     * @return AggregationBuilder
     */
    private function scopeMostAppeared(AggregationBuilder $aggregationBuilder, string $field) : AggregationBuilder
    {
        $aggregationBuilder
            ->unwind("$$field")
            ->group()
            ->field("id")
            ->expression("$$field")
            ->field($field."Count")
            ->sum(1)
            ->sort($field."Count", 'desc')
            ->match()
            ->field($field."Count")
            ->equals(6)
        ;

        return $aggregationBuilder;
    }

    /**
     * Add limit
     *
     * @param AggregationBuilder $aggregationBuilder
     * @param int $limit
     *
     * @return AggregationBuilder
     */
    private function scopeLimit(AggregationBuilder $aggregationBuilder, int $limit) : AggregationBuilder
    {
        $aggregationBuilder->limit($limit);

        return $aggregationBuilder;
    }
}
