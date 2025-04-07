<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_list extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required',
        'year' => ''
    ];
}
