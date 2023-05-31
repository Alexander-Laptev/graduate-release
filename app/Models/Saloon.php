<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saloon extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'street',
        'home',
        'picture',
        'open',
        'close',
        'number_phone',
        'description',
    ];
    protected $casts = [
        'open' => 'datetime',
        'close' => 'datetime',
    ];
}
