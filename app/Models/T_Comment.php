<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Y_Subject;


class T_Comment extends Model
{
    use HasFactory;
    // リレーション
    public function Teacher(){  
        return $this->belongsTo(Teacher::class);
    }
    public function Y_Subject(){  
        return $this->belongsTo(Y_Subject::class);
    }
}
