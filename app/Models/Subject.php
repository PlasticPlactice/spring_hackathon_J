<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Y_Subject;
use App\Models\S_Comment;
use App\Models\Subject_Favorite;



class Subject extends Model
{
    use HasFactory;

    // リレーション
    public function Y_Subjects(){
        return $this->hasMany(Y_Subject::class);
    }
    public function S_Comments(){
        return $this->hasMany(S_Comment::class);
    }
    public function Subject_Favorites(){
        return $this->hasMany(Subject_Favorite::class);
    }
}
