<?php

namespace Mtsung\Mapsapi\GoogleMap;


/**
 * Class Geocoding
 *
 * @package Mtsung\Mapsapi\GoogleMap
 * @see https://developers.google.com/maps/documentation/geocoding
 */
class Geocoding extends Service
{
    const API_URI = '/maps/api/geocode/json';

    /**
     * Geocode
     *
     * @param Client $client
     * @param string $address
     * @param array $params Query parameters: ['bounds', 'language', 'region', 'components']
     * @return array|mixed
     *
     * @see https://developers.google.com/maps/documentation/geocoding/overview#GeocodingRequests
     */
    public static function geocode(Client $client, string $address, $params = [])
    {
        $params['address'] = $address;

        return self::requestHandler($client, self::API_URI, $params);
    }

    /**
     * Reverse Geocode
     *
     * @param Client $client
     * @param $latlng
     * @param array $params Query parameters: ['language', 'result_type', 'location_type']
     * @return array|mixed $latlng ['lat', 'lng'] or latlng string
     *
     * @see https://developers.google.com/maps/documentation/geocoding/overview#ReverseGeocoding
     */
    public static function reverseGeocode(Client $client, $latlng, $params = [])
    {
        if (is_string($latlng)) {
            $params['latlng'] = $latlng;
        } else {
            list($lat, $lng) = $latlng;
            $params['latlng'] = "{$lat},{$lng}";
        }

        return self::requestHandler($client, self::API_URI, $params);
    }
}