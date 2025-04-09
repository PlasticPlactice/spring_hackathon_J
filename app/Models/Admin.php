<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 


class Admin extends Authenticatable
{
    use HasFactory;
    
    public static $rules = [
        'id' => 'required',
        'pw' => 'required'
    ];
    protected $casts = [
        'id' => 'string',  // idを文字列としてキャスト
    ];


     // パスワードを 'pw' カラムから取得する
     public function getAuthPassword()
     {
         return $this->pw;  // pwカラムを認証のパスワードとして使用
     }
   

}
