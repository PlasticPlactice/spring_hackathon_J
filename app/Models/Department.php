<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;


class Department extends Model
{
    use HasFactory;

    // リレーション
    public function Students(){
        return $this->hasMany(Student::class);
    }

 


}
