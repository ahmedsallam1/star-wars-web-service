<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FilmService;
use App\Contract\ApiResponseInterface;
use Swagger\Annotations as SWG;

/**
 * Class FilmController
 * @package App\Controller
 * @Route("/api", name="api_")
 */
class FilmController
{
    /**
     * List film
     *
     * @Rest\Get("/films")
     * @SWG\Response(
     *     response=200,
     *     description="Returns film",
     * )
     * @SWG\Parameter(
     *     name="longest",
     *     in="query",
     *     type="string",
     *     description="The field used to order film"
     * )
     * @SWG\Tag(name="film")
     *
     * @param Request $request
     * @param FilmService $filmService
     * @param ApiResponseInterface $response
     *
     * @return mixed
     */
    public function index(Request $request, FilmService $filmService, ApiResponseInterface $response)
    {
        return $response
            ->setData($filmService->getOneBy($request->query->all()))
            ->toJson()
        ;
    }
}
