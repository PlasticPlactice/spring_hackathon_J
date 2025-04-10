<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course_list;

// 生徒が履修する科目を登録する
class C_Subject extends Model
{
    use HasFactory;

    protected $table = 'CSubject';

    // リレーション
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function Course_list(){
        return $this->belongsTo(Course_list::class);
    }


}
