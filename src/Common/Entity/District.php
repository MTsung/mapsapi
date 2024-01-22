<?php

namespace Mtsung\Mapsapi\Common\Entity;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function getTable(): string
    {
        return env('MAPSAPI_DISTRICT_TABLE_NAME', 'districts');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}