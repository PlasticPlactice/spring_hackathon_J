<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Y_Subject;

class Subject_Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'y_subject_id'
    ];

    protected $table = 'subject_favorites';

    public static function createSubjectFavorite($data) {
        return self::create($data);
    }
    // リレーション
    public function Student(){
        return $this->belongsTo(Student::class);
    }
    public function Y_Subject(){
        return $this->belongsTo(Y_Subject::class);
    }
}



