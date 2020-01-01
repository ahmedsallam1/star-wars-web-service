<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Service\FilmService;
use App\Contract\ApiResponseInterface;

/**
 * Movie controller.
 * @Route("/api", name="api_")
 */
class FilmController
{
    /**
    * Lists all Movies.
    * @Rest\Get("/films")
    *
    * @param Request $request
    * @param FilmService $filmService
    * @param ApiResponseInterface $response
    *
    * @return View
    */
    public function index(Request $request, FilmService $filmService, ApiResponseInterface $response)
    {
        return $response
            ->setData($filmService->getOneBy($request->query->all()))
            ->toJson()
        ;
    } 
}
