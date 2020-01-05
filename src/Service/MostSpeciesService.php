<?php
namespace App\Service;

/**
 * Class MostSpeciesService
 * @package App\Service
 */
final class MostSpeciesService
{
    /**
     * @var FilmService
     */
    private $filmService;

    /**
     * @var PeopleService
     */
    private $peopleService;

    /**
     * @param FilmService $filmService
     * @param SpeciesService $speciesService
     */
    public function __construct(FilmService $filmService, SpeciesService $speciesService)
    {
        $this->filmService = $filmService;
        $this->speciesService = $speciesService;
    }

    /**
     * @param array $criteria
     * @return null|object
     */
    public function getBy(array $criteria)
    {
        $species = null;

        if (method_exists($this, 'scope'.array_key_first($criteria))) {
            $species = $this->{'scope'.array_key_first($criteria)}();
        }

        return $species;
    }

    /**
     * Find species appeared in most movies
     *
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    private function scopeIsMostAppeared()
    {
        $mostAppearedId = $this->filmService->getBy([
            'mostAppeared' => 'species',
            'limit' => 100
        ]);

        return $this
            ->speciesService
            ->getBy([
                'id' => array_column($mostAppearedId, '_id'), 'getSizeOf' => 'people'
            ])->toArray();
    }
}
