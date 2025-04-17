<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Y_Subject;


class T_Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 't_comments';

    protected $fillable = [
        'y_subject_id',
        'teacher_id',
        'title',
        'detail',
        'link_flg',
        'del_flg'
    ];

    public static $rules = [
        'title' => 'required',
        'detail' => ''
    ];

    public static function createTComment($data) {
        return self::create([
            'y_subject_id' => $data['y_subject_id'],
            'teacher_id' => $data['teacher_id'],
            'title' => $data['title'],
            'detail' => $data['detail'],
            'link_flg' => $data['link_flg'],
            'del_flg' => $data['del_flg'],
        ]);
    }

    public static function deleteTComment($id) {
        return self::where('id', $id)
            ->update([
                'del_flg' => true,
            ]);
    }

    // リレーション
    public function Teacher(){  
        return $this->belongsTo(Teacher::class);
    }   
    public function Y_Subject(){  
        return $this->belongsTo(Y_Subject::class);
    }
}
