<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table = 'maps';

    /**
     * Get the maps associated with the Map
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function maps()
    {
        return $this->hasOne(TableMap::class, 'map_id', 'id');
    }
}
