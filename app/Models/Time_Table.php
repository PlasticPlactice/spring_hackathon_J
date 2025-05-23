<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;


class Time_Table extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'time_tables';

    public static $rules = [
        'day_of_week' => '',
        'frames' => ''
    ];

    // リレーション
    public function Course_list(){  
        return $this->belongsTo(Course_list::class);
    }

}
