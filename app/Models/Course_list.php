<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\C_Subject;
use App\Models\Time_Table;
use App\Models\Teacher;
use App\Models\Y_Subject;


class Course_list extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required',
        'year' => ''
    ];

    // リレーション
    public function C_Subjects(){
        return $this->hasMany(C_Subject::class);
    }

    public function Time_Tables(){
        return $this->hasMany(Time_Table::class);
    }
    public function Teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function Y_Subjects(){
        return $this->hasOne(Y_Subject::class);
    }

}
