<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Y_Subject;
use App\Models\S_Comment;
use App\Models\Subject_Favorite;



class Subject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'detail',
        'tech'
    ];

    public static $rules = [
        'name' => 'required',
        'detail' => '',
        'tech' => 'required'
    ];

    public static function CreateSubject($name, $detail, $tech) {
        return self::create([
            'name' => $name,
            'detail' => $detail,
            'tech' => $tech
        ]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateSubject($id, $data) {
        return self::where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public static function deleteSubject($id) {
        return self::where('id', $id)->delete();
    }

    // リレーション
    public function Y_Subjects(){
        return $this->hasMany(Y_Subject::class);
    }
    public function S_Comments(){
        return $this->hasMany(S_Comment::class);
    }
    public function Subject_Favorites(){
        return $this->hasMany(Subject_Favorite::class);
    }
}
