<?php
namespace App\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\Aggregation\Builder as AggregationBuilder;
use App\Document\Film;
use Doctrine\ODM\MongoDB\DocumentManager;

final class FilmRepository
{
	/**
     * @var DocumentRepository
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
			->includeFields(['title'])
		;

        return $aggregationBuilder;
	}

	/**
	 * Add sort by specific field descendingly
	 * limited by 1 result
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
        	->field('openingCrawlLength')
        	->expression($aggregationBuilder->expr()->strLenBytes('$openingCrawl'))
        	->sort('openingCrawlLength', 'desc')
        	->limit(1)
        ;

        return $aggregationBuilder;
	}
}
