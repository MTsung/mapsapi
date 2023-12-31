<?php

namespace Mtsung\Mapsapi\TwddMap;

use Mtsung\Mapsapi\TwddMap\Service\GeocodingService;

class Geocoding
{
    /**
     * Geocode
     *
     * @param string $address
     * @return array
     */
    public static function geocode(string $address): array
    {
        $service = new GeocodingService();
        return $service->geocode($address);
    }

    /**
     * Reverse Geocode
     *
     * @param string $latlon
     * @return array
     */
    public static function reverseGeocode(string $latlon): array
    {
        $service = new GeocodingService();
        return $service->reverseGeocode($latlon);
    }
}