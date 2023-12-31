<?php

namespace Mtsung\Mapsapi\Map8;


/**
 * Class Geocoding
 *
 * @package Mtsung\Mapsapi\Map8
 * @see https://www.map8.zone/map8-api-docs/#places-2
 */
class Geocoding extends Service
{
    const API_URI = '/v2/place/geocode/json';

    /**
     * Geocode
     *
     * @param Client $client
     * @param string $address
     * @param array $params Query parameters: ['postcode', 'formatted_address_embed_postcode']
     * @return array|mixed
     */
    public static function geocode(Client $client, string $address, $params = [])
    {
        $params['address'] = $address;

        // Show Postal code
        $params['postcode'] = $params['postcode'] ?? true;

        return self::requestHandler($client, self::API_URI, $params);
    }

    /**
     * Reverse Geocode
     *
     * @param Client $client
     * @param $latlng
     * @param array $params Query parameters: ['postcode', 'formatted_address_embed_postcode']
     * @return array|mixed $latlng ['lat', 'lng'] or latlng string
     */
    public static function reverseGeocode(Client $client, $latlng, $params = [])
    {
        if (is_string($latlng)) {
            $params['latlng'] = $latlng;
        } else {
            list($lat, $lng) = $latlng;
            $params['latlng'] = "{$lat},{$lng}";
        }

        // Show Postal code
        $params['postcode'] = $params['postcode'] ?? true;

        $results = self::requestHandler($client, self::API_URI, $params);

        if ($results['code'] == 200) {
            $_latlng = explode(',', $params['latlng']);
            $results['data'][0]['geometry']['location']['lat'] = $_latlng[0];
            $results['data'][0]['geometry']['location']['lng'] = $_latlng[1];
        }

        return $results;
    }
}