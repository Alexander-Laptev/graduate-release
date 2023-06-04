<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule_master extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_id',
        'employee_id',
        'start',
        'end',
    ];
}
