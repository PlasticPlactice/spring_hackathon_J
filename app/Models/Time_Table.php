<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;


class Time_Table extends Model
{
    use HasFactory;

    // リレーション
    public function Course_list(){  
        return $this->belongsTo(Student::class);
    }

}
