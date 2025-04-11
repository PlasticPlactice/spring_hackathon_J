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

    protected $fillable = [
        'student_id',
        'course_list_id'
    ];

    protected $table = 'c_subjects';

    public static function createCSubject($student_id, $course_list_id) {
        return self::create([
            'student_id' => $student_id,
            'course_list_id' => $course_list_id
        ]);
    }

    // リレーション
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function Course_list(){
        return $this->belongsTo(Course_list::class);
    }


}
