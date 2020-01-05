<?php
namespace App\Service;

use App\Repository\FilmRepository;

/**
 * Class FilmService
 * @package App\Service
 */
final class FilmService
{
    /**
     * @var FilmRepository
     */
    private $repository;

    /**
     * @param FilmRepository $filmRepository
     */
    public function __construct(FilmRepository $filmRepository)
    {
        $this->repository = $filmRepository;
    }

    /**
     * Find films by criteria
     * return first result
     *
     * @param array $criteria
     *
     * @return array
     */
    public function getOneBy(array $criteria = []) : array
    {
        return $this->repository->findOneBy($criteria)->execute()->current();
    }

    /**
     * Find films by criteria
     *
     * @param array $criteria
     *
     * @return array
     */
    public function getBy(array $criteria = []) : array
    {
        return $this->repository->findOneBy($criteria)->execute()->toArray();
    }
}
