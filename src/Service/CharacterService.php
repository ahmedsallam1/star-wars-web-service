<?php
namespace App\Service;

/**
 * Class CharacterService
 * @package App\Service
 */
final class CharacterService
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
     * @param PeopleService $peopleService
     */
    public function __construct(FilmService $filmService, PeopleService $peopleService)
    {
        $this->filmService = $filmService;
        $this->peopleService = $peopleService;
    }

    /**
     * @param array $criteria
     * @return null|object
     */
    public function getBy(array $criteria)
    {
        $character = null;

        if (method_exists($this, 'scope'.array_key_first($criteria))) {
            $character = $this->{'scope'.array_key_first($criteria)}();
        }

        return $character;
    }

    /**
     * Find most appeared character in movies
     *
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    private function scopeIsMostAppeared()
    {
        $mostAppearedId = $this->filmService->getOneBy([
            'mostAppeared' => 'characters'
        ]);

        return $this->peopleService->getBy(['id' => $mostAppearedId['_id']])->current();
    }
}
