<?php
namespace App\Contract;

interface ApiResponseInterface 
{
	/**
	 * @return string
	 */
	public function toJson();
}
