<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'saloon_id',
        'service_id',
        'schedule_id',
        'time',
        'status',
    ];
}
