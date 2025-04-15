<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Subject;


class S_Comment extends Model
{
    use HasFactory;

    protected $table = 's_comments';

    protected $guarded = [
        'title' => 'required',
        'detail' => ''
    ];

    protected $fillable = [
        'subject_id',
        'student_id',
        'title',
        'detail'
    ];

    public static function CreateSComment($subject_id, $student_id, $title, $detail) {
        return self::create([
            'subject_id' => $subject_id,
            'student_id' => $student_id,
            'title' => $title,
            'detail' => $detail,
        ]);
    }

    // リレーション
    public function Student(){
        return $this->belongsTo(Student::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
}
