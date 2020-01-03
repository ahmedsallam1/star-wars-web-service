<?php
namespace App\Factory;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class HttpResponseFactory
 * @package App\Factory
 */
class HttpResponseFactory
{
    /**
    * @return Response
    */
    public static function create()
    {
        return new Response();
    }
}
