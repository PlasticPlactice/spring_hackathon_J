<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Y_Subject_Favorite;
use App\Models\Course_list;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject_Favorite;

class TeacherController extends Controller
{
    // 教師トップページ表示
    public function index(Request $request){

        $teacher_id = Auth::guard('teacher')->id();

        // お気に入りの表示
        $ySubjectFavorites = Y_Subject_Favorite::where('teacher_id', $teacher_id)->get();
        // Course_listsを取得する
        $courseLists = [];
        foreach ($ySubjectFavorites as $favorite) {
            $course = Course_list::where('id', $favorite->y_subject_id)->first();
            if ($course) {
                $courseLists[] = $course;
            }
        }
        

        return view('teacher/teacher_top', ['courseLists' => $courseLists]);
    }

      // お気に入り登録
      public function createFavorite(Request $request,$id) {
        // 科目のidを取得
        $subjectId = $id;
        if (Auth::guard('teacher')->check()) {
            $teacherId = Auth::guard('teacher')->id();
            $subjectFavorite = new Y_Subject_Favorite;
            $subjectFavorite->teacher_id = $teacherId;
            $subjectFavorite->y_subject_id = $subjectId;
            $subjectFavorite->save();        
        } 
        return redirect()->back();
        
    }

    // お気に入り削除
    // 余裕があったら
    public function deleteFavorite(Request $request,$id) {
        $subjectId = $id;
        // dd($subjectId);
      if (Auth::guard('teacher')->check()) {
            $teacherId = Auth::guard('teacher')->id();
            Y_Subject_Favorite::where('teacher_id',$teacherId)->where('y_subject_id',$subjectId)->delete();     
        } else {
        }
        return redirect()->back();
    }
}
