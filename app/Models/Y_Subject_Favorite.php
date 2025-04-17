<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Y_Subject;

class Y_Subject_Favorite extends Model
{
    use HasFactory;


    protected $fillable = [
        'teacher_id',
        'y_subject_id'
    ];

    protected $table = 'y_subject_favorites';

    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }

}
