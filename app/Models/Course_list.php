<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\C_Subject;
use App\Models\Time_Table;
use App\Models\Teacher;
use App\Models\Y_Subject;


class Course_list extends Model
{
    use HasFactory;

    protected $table = 'course_lists';

    protected $fillable = [
        'teacher_id',
        'title',
        'year',
        'session_flg'
    ];

    // protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required',
        'year' => ''
    ];

    // データ格納処理
    public static function createCourseList($teacher_id, $title, $year, $session_flg) {
        return self::create([
            'teacher_id' => $teacher_id,
            'title' => $title,
            'year' => $year,
            'session_flg' => $session_flg,
        ]);
    }

    /**
     * 指定されたIDのCourse_listを更新する
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateCourseList($id, $data)
    {
        // 指定されたIDのレコードを取得し、更新する
        return self::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteCourseList($id) {
        return self::where('id', $id)->delete();
    }

    // リレーション
    public function C_Subjects(){
        return $this->hasMany(C_Subject::class);
    }

    public function Time_Tables(){
        return $this->hasMany(Time_Table::class);
    }
    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function Y_Subjects(){
        return $this->hasOne(Y_Subject::class);
    }

}
