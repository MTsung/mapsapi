<?php

namespace Mtsung\Mapsapi\Common\Repository;

use Mtsung\Mapsapi\Common\Entity\LatLonMap;

use Illuminate\Support\Facades\Log;

class LatLonMapRepository
{
    /**
     * Get LatLon Info
     *
     * @param string $latLon
     * @return array
     */
    public static function getWithLatLon(string $latLon): array
    {
        $data = [];

        // Change coordinates format: lon, lat
        $coordinates = array_map(function ($item) {
            return floatval(trim($item));
        }, array_reverse(explode(',', $latLon)));

        try {
            $data = LatLonMap::where('latlon', 'near', [
                '$geometry' => [
                    'type' => 'Point',
                    'coordinates' => $coordinates,
                ],
                '$maxDistance' => 50,
            ])->first();

            $data = ($data) ? $data->toArray() : [];

        } catch (\Throwable $e) {
            Log::error($e);

            return [
                'msg' => $e->getMessage()
            ];
        }

        return $data;
    }
}