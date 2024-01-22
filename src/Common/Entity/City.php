<?php

namespace Mtsung\Mapsapi\Common\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public function getTable(): string
    {
        return env('MAPSAPI_CITY_TABLE_NAME', 'cities');
    }

    public function district(): HasMany
    {
        return $this->hasMany(District::class, 'city_id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}