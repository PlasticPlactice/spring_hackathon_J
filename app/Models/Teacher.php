<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;
use App\Models\T_Comment;
use App\Models\Y_Subject_Favorite;



class Teacher extends Model
{
    use HasFactory;
    // リレーション
    public function Course_list(){  
        return $this->belongsTo(Student::class);
    }
    public function T_Comments(){
        return $this->hasMany(T_Comments::class);
    }
    public function Y_Subject_Favorites(){
        return $this->hasMany(Y_Subject_Favorite::class);
    }


}
