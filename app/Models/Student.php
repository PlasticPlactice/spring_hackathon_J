<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\C_Subject;
use App\Models\S_Comment;
use App\Models\Subject_Favorite;

class Student extends Model
{
    use HasFactory;

<<<<<<< HEAD
    public static $rules = [
        'id' => 'required',
        'pw' => 'required',
        'name' => 'required',
        'img_path' => 'required',
        'entrance_year' => 'required'
    ];
=======
    // リレーション
    public function S_Comments(){
        return $this->hasMany(S_Comment::class);
    }
    // 履修科目テーブルへのリレーション
    public function C_Subjects(){
        return $this->hasMany(C_Subject::class);
    }
    public function Subject_Favorites(){
        return $this->hasMany(Subject_Favorite::class);
    }

    
>>>>>>> 5dcba6d98274fc18e8c349f80c0e17a9cb4f438b
}
