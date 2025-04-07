<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Y_Subject;


class T_Comment extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required',
        'detail' => ''
    ];
=======
    // リレーション
    public function Teacher(){  
        return $this->belongsTo(Teacher::class);
    }
    public function Y_Subject(){  
        return $this->belongsTo(Y_Subject::class);
    }
>>>>>>> 5dcba6d98274fc18e8c349f80c0e17a9cb4f438b
}
