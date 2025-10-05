<?php

namespace App\Models;

use Illuminate\Database\Factories;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    

    // Product model defines what database columns can be mass-assigned: ot
    // Talks directly to the database (Eloquent ORM)
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'status',
        'is_available',
    ];
}
