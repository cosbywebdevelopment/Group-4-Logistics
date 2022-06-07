<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'height',
        'width',
        'pallets',
        'max_weight',
        'min_charge',
        'per_mile',
        'collection_5',
        'collection_weekend',
        'display',

    ];


}
