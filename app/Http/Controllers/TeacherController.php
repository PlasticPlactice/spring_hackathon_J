<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Y_Subject_Favorite;
use App\Models\Course_list;
use Illuminate\Support\Facades\Auth;

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
}
