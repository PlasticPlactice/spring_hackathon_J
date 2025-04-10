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

    protected $table = 'y_subjects';

    protected $fillable = [
        'course_list_id',
        'subject_id',
        'detail'
    ];

    public static $rules = [
        'detail' => 'required',
    ];

    // データ格納処理
    public static function createYSubject($course_list_id, $subject_id, $detail) {
        return self::create([
            'course_list_id' => $course_list_id,
            'subject_id' => $subject_id,
            'detail' => $detail,
        ]);
    }

    /**
     * @param int $course_list_id
     * @return bool
     */
    public static function deleteYSubject($id) {
        return self::where('course_list_id', $id)->delete();
    }

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
