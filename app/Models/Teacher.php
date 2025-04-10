<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_list;
use App\Models\T_Comment;
use App\Models\Y_Subject_Favorite;



class Teacher extends Authenticatable
{
    use HasFactory;

    protected $keyType = 'string';

    public static $rules = [
        'id' => 'required',
        'pw' => 'required',
        'name' => 'required'
    ];
    protected $casts = [
        'id' => 'string',  // idを文字列としてキャスト
    ];


    // リレーション
    public function Course_lists(){
        return $this->hasMany(Student::class);
    }
    public function T_Comments(){
        return $this->hasMany(T_Comments::class);
    }
    public function Y_Subject_Favorites(){
        return $this->hasMany(Y_Subject_Favorite::class);
    }

    // パスワードを 'pw' カラムから取得する
    public function getAuthPassword()
    {
        return $this->pw;  // pwカラムを認証のパスワードとして使用
    }
  

}
