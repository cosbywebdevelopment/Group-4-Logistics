<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'type',
        'pickup',
        'drop_off',
        'time',
        'date',
        'package',
        'mileage',
        'cost',
        'payment_method',
        'remove',
    ];
}
