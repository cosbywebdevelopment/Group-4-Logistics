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
        'drop_date',
        'drop_time',
        'package',
        'mileage',
        'cost',
        'payment_method',
        'remove',
        'ref',
        'pickup_contact',
        'delivery_contact',
        'delivery_info',
        'size',
        'weight',
        'notes',
        'confirm',
    ];
}
