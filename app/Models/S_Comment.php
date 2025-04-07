<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\S_Comment;


class S_Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'title' => 'required',
        'detail' => ''
    ];

    // リレーション
    public function Student(){
        return $this->belongsTo(Student::class);
    }
    public function S_Comment(){
        return $this->belongsTo(S_Comment::class);
    }
}
