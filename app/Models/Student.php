<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model;
use App\Models\C_Subject;
use App\Models\S_Comment;
use App\Models\Subject_Favorite;
use App\Models\Department;



class Student extends  Authenticatable
{
    use HasFactory;

    // ユーザー認証に使うカラムの指定（必要に応じて追加）
    protected $fillable = ['id', 'pw'];  // 'password' を 'pw' に変更
    
    public static $rules = [
        'id' => 'required',
        'pw' => 'required',
        'name' => 'required',
        'img_path' => 'required',
        'entrance_year' => 'required'
    ];
    
    protected $casts = [
        'id' => 'string',  // idを文字列としてキャスト
    ];

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
    public function Department(){
        return $this->hasMany(Department::class);
    }


     // パスワードを 'pw' カラムから取得する
     public function getAuthPassword()
     {
         return $this->pw;  // pwカラムを認証のパスワードとして使用
     }

    
}
