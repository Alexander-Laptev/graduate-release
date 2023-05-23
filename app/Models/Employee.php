<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'patronymic',
        'birthday',
        'workday',
        'gender',
        'experience',
        'address',
        'number_phone',
        'post_id',
        'saloon_id',
        'picture',
        'description',
    ];
}
