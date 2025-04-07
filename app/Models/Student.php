<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public static $rules = [
        'id' => 'required',
        'pw' => 'required',
        'name' => 'required',
        'img_path' => 'required',
        'entrance_year' => 'required'
    ];
}
