<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;


class Time_Table extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $guarded = ['id'];

    public static $rules = [
        'day_of_week' => '',
        'frames' => ''
    ];
=======
    // リレーション
    public function Course_list(){  
        return $this->belongsTo(Student::class);
    }

>>>>>>> 5dcba6d98274fc18e8c349f80c0e17a9cb4f438b
}
