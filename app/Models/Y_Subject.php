<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;
use App\Models\T_Comment;
use App\Models\Subject;
use App\Models\Y_Subject_Favorite;


class Y_Subject extends Model
{
    use HasFactory;

    public static $rules = [
        'detail' => 'required',
    ];

    // リレーション
    public function Course_list(){
        return $this->belongsTo(Course_list::class);
    }
    public function T_Comments(){
        return $this->hasMany(T_Comment::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }
    public function Y_Subject_Favorites(){
        return $this->hasMany(Y_Subject_Favorite::class);
    }


}
