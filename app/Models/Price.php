<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * Get all of the extramount for the Price
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extraprice()
    {
        return $this->hasMany(ExtraAmount::class, 'price_id', 'id');
    }
}
