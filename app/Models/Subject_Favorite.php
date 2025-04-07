<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;

class Subject_Favorite extends Model
{
    use HasFactory;
    // リレーション
    public function Student(){
        return $this->belongsTo(Student::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
}



