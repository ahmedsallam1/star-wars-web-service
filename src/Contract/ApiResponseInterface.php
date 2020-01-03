<?php
namespace App\Contract;

/**
 * Interface ApiResponseInterface
 * @package App\Contract
 */
interface ApiResponseInterface
{
    /**
     * @return mixed
     */
    public function toJson();
}
