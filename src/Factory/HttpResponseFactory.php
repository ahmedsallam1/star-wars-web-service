<?php
namespace App\Factory;

use Symfony\Component\HttpFoundation\Response;

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
