<?php

namespace Mtsung\Mapsapi\Common\Entity;

use MongoDB\Laravel\Eloquent\Model;

class LatLonMap extends Model
{
    /**
     * Connection Driver Name
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Collection Name
     *
     * @var string
     */
    protected $collection = 'latlon_maps';
}