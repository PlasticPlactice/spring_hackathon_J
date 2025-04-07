<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_Table extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'day_of_week' => '',
        'frames' => ''
    ];
}
