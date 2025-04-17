<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course_list;
use App\Models\C_Subject;
use App\Models\Time_Table;
use App\Models\Subject_Favorite;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 生徒トップページ表示
    public function index(Request $request){

        // ログイン中の生徒idを取得する
        $student_id = Auth::guard('student')->id();

        // course_listのデータを取得
        // 年度指定と前期後期のwhereはお好みで
        $course_list = Course_list::where('year', '>', Carbon::now()->year)
        ->where('session_flg', 0)
        ->get();

        $timeTables = Time_Table::with(['Course_list'])->get();

        // 連想配列を用意
        $timeTableGrid = [];
        for ($day = 0; $day < 5; $day++) {
            for ($period = 0; $period < 4; $period++) {
                $timeTableGrid[$day][$period] = [
                'title' => '',
                'id'    => null,
                ];
            }
        }

        // 配列に格納
        foreach($timeTables as $timeTable) {
            $day = $timeTable->day_of_week;
            $frames = $timeTable->frames;

            if (isset($timeTableGrid[$day][$frames])) {
                $timeTableGrid[$day][$frames] = [
                    'title' => $timeTable->Course_list->title ?? '',
                    'id'    => $timeTable->Course_list->id ?? null,
                ];
            }
        }
        $days = ['月', '火', '水', '木', '金'];

        // お気に入りに登録しているデータ取得
        $subjectFavorite = Subject_Favorite::where('student_id', $student_id)->get();
        // Course_listsを取得する
        $courseLists = [];
        foreach ($subjectFavorite as $favorite) {
            $course = Course_list::where('id', $favorite->y_subject_id)->first();
            if ($course) {
                $courseLists[] = $course;
            }
        }



        return view('student/student_top', ['timeTables' => $timeTableGrid, 'days' => $days, 'courseLists' => $courseLists]);
    }
    
    // 個別時間割作成ページ表示
    public function addTimeTable(Request $request){
        $CourseLists = Course_list::with('Time_Tables')->get();
        return view('student/personal_timetable_register', ['CourseLists' => $CourseLists]);
    }

    public function createTimeTable(Request $request) {

        $student_id = Auth::guard('student')->id();
        $course_list_id = $request->course_list_id;

        C_Subject::createCSubject($student_id, $course_list_id);
        return view('student/student_top');
    }
    
    // 個別時間割編集ページ表示
    public function editTimeTable(Request $request){
        return view('student/personal_timetable_edit');
    }

    // お気に入り登録
    public function createFavorite(Request $request) {

    }

    // お気に入り削除
    // 余裕があったら
    public function deleteFavorite(Request $request) {

    }
}
