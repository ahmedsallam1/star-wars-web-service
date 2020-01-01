<?php
namespace App\Service;

use App\Repository\FilmRepository;

final class FilmService
{
    /**
     * @var DocumentRepository
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
     *
     * @param array $criteria
     *
     * @return Query
     */
    public function getOneBy(array $criteria = [])
    {
        return $this->repository->findOneBy($criteria)->execute()->current();
    }
}
