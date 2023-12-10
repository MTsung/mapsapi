<?php

namespace Mtsung\Mapsapi\Common\Repository;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Mtsung\Mapsapi\Common\Entity\District;

class DistrictRepository
{
    /**
     * Get District Info
     *
     * @param string $name
     * @return array
     */
    public static function getByName(string $name): array
    {
        $data = [];

        try {
            $data = District::where('name', $name)->get()->toArray();
        } catch (QueryException $queryException) {
            Log::error(__METHOD__, [$queryException]);
        }

        return $data;
    }
}