<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'document',
        'residence',
        'province',
        'friend_group',
        'guy',
        'number_of_children'
    ];
}
