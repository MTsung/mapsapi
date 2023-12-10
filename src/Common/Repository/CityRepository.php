<?php

namespace Mtsung\Mapsapi\Common\Repository;

use Mtsung\Mapsapi\Common\Entity\City;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CityRepository
{
    /**
     * Get City Info
     *
     * @param string $name
     * @return array
     */
    public static function getByName(string $name): array
    {
        $data = [];

        try {
            $data = City::where('name', $name)->get()->toArray();
        } catch (QueryException $queryException) {
            Log::error($queryException);
        }

        return $data;
    }
}