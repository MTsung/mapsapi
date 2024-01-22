<?php

namespace Mtsung\Mapsapi\Common\Repository;

use Mtsung\Mapsapi\Common\Entity\City;
use Mtsung\Mapsapi\Common\Entity\District;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class AresRepository
{
    /**
     * Get Area Info
     *
     * @param int $postcode
     * @return array
     */
    public static function getByZip(int $postcode): array
    {
        $data = [];

        try {
            // 五碼轉三碼
            if ($postcode > 999) {
                $postcode = floor($postcode / 100);
            }

            $data = District::query()
                ->select(
                    City::getTableName() . '.id as city_id',
                    District::getTableName() . '.id as district_id',
                    'zip_code as zip'
                )
                ->join(City::getTableName(), District::getTableName() . '.city_id', City::getTableName() . '.id')
                ->where('zip_code', $postcode)
                ->first();

            $data = ($data) ? $data->toArray() : [];

        } catch (QueryException $queryException) {
            Log::error($queryException);
        }

        return $data;
    }

    /**
     * Get Area Info
     *
     * @param string $city
     * @param string $district
     * @return array
     */
    public static function getByCityDistrict(string $city, string $district): array
    {
        $data = [];

        try {
            $data = District::query()
                ->select(
                    City::getTableName() . '.id as city_id',
                    District::getTableName() . '.id as district_id',
                    'zip_code as zip'
                )
                ->join(City::getTableName(), District::getTableName() . '.city_id', City::getTableName() . '.id')
                ->where(City::getTableName() . '.name', $city)
                ->where(District::getTableName() . '.name', $district)
                ->first();

            $data = ($data) ? $data->toArray() : [];

        } catch (QueryException $queryException) {
            Log::error($queryException);
        }

        return $data;
    }
}