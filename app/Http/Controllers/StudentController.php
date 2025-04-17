<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course_list;
use App\Models\C_Subject;
use App\Models\Time_Table;
use App\Models\Subject_Favorite;
use App\Models\Y_Subject_Favorite;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 生徒トップページ表示
    public function index(Request $request){

        // ログイン中の生徒idを取得する
        $student_id = Auth::guard('student')->id();
          // ① 最大の year を取得
          $maxYear = Course_list::max('year');

          // ② その year における最大の session_flg を取得
          $maxSessionFlg = Course_list::where('year', $maxYear)->max('session_flg');

        // 現在生徒が履修している情報を取得
        $studentCourseList = Course_list::where('year', $maxYear)
        ->where('session_flg', $maxSessionFlg)
        ->whereHas('C_Subjects', function($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
        ->with(['C_Subjects' => function($query) use ($student_id) {
            $query->where('student_id', $student_id);
        }])
        ->get()->pluck('id')->toArray();
 
        //生徒が履修している科目の時間割を取得 
        $timeTables = Time_Table::whereIn('course_list_id',$studentCourseList)->with(['Course_list'])->get();

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
        // 現在管理者時間割に登録されている最新のデータを取得
        // ① 最大の year を取得
        $maxYear = Course_list::max('year');

        // ② その year における最大の session_flg を取得
        $maxSessionFlg = Course_list::where('year', $maxYear)->max('session_flg');

        // ③ 条件に合致する Course_list と関連する Time_Table を取得
        $courseLists = Course_list::where('year', $maxYear)
            ->where('session_flg', $maxSessionFlg)
            ->with(['Time_Tables' => function($query) use ($maxYear, $maxSessionFlg) {
                // Time_Table に対して追加条件を設定
                $query->whereHas('course_list', function($query) use ($maxYear, $maxSessionFlg) {
                    $query->where('year', $maxYear)
                        ->where('session_flg', $maxSessionFlg);
                });
            }])->get();
            $days = ['月', '火', '水', '木', '金'];


        return view('student/personal_timetable_register', ['courseLists' => $courseLists,'days' => $days]);
    }

    public function createTimeTable(Request $request) {

        $student_id = Auth::guard('student')->id();
        $course_list_id = $request->course_list_id;

        C_Subject::createCSubject($student_id, $course_list_id);
        return view('student/student_top');
    }
    
    // 個人時間割登録処理
    public function insertTimeTable(Request $request){
        // ログイン中の生徒idを取得する
        $student_id = Auth::guard('student')->id();
        $items = $request->input('items');
        if ($items) {
            foreach ($items as $item) {
                $cSubject = new C_Subject;
                $cSubject->student_id = $student_id;
                $cSubject->course_list_id = $item;
                $cSubject->save();
            }
        }

        // 生徒トップにリダイレクト
        return redirect()->route('sbuject_masatar_edit_view');  
        
    }
    // 個別時間割編集ページ表示
    public function editTimeTable(Request $request){
        $student_id = Auth::guard('student')->id();

        // 現在管理者時間割に登録されている最新のデータを取得
        // ① 最大の year を取得
        $maxYear = Course_list::max('year');

        // ② その year における最大の session_flg を取得
        $maxSessionFlg = Course_list::where('year', $maxYear)->max('session_flg');

        // ③ 条件に合致する Course_list と関連する Time_Table を取得
        $courseLists = Course_list::where('year', $maxYear)
            ->where('session_flg', $maxSessionFlg)
            ->with(['Time_Tables' => function($query) use ($maxYear, $maxSessionFlg) {
                // Time_Table に対して追加条件を設定
                $query->whereHas('course_list', function($query) use ($maxYear, $maxSessionFlg) {
                    $query->where('year', $maxYear)
                        ->where('session_flg', $maxSessionFlg);
                });
            }
            ])->get();

        // 現在生徒が履修している情報を取得
        DB::enableQueryLog();
        $studentCourseList = Course_list::where('year', $maxYear)
        ->where('session_flg', $maxSessionFlg)
        ->whereHas('C_Subjects', function($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })
        ->with(['C_Subjects' => function($query) use ($student_id) {
            $query->where('student_id', $student_id);
        }])
        ->get()->pluck('id');;

            $days = ['月', '火', '水', '木', '金'];


        return view('student/personal_timetable_edit', ['courseLists' => $courseLists,'days' => $days,'studentCourseList' => $studentCourseList]);

    }

    // 個別時間割編集処理
    public function updateTimeTable(Request $request){
         // ログイン中の生徒idを取得する
         $studentId = Auth::guard('student')->id();
        //  元々の時間割データを取得
         $studentCourseList = json_decode($request->input('studentCourseList'));
        //  dd($studentCourseList);
        // 元々の時間割データを削除
        foreach($studentCourseList as $courseListId){
            C_Subject::where('student_id', $studentId)->where('course_list_id', $courseListId)->delete();
        }
        // 新たにデータを登録
         $items = $request->input('items');
         if ($items) {
             foreach ($items as $item) {
                 $cSubject = new C_Subject;
                 $cSubject->student_id = $studentId;
                 $cSubject->course_list_id = $item;
                 $cSubject->save();
             }
         }
 
         // 生徒トップにリダイレクト
         return redirect()->route('student.top');  
         
    }

    // お気に入り登録
    public function createFavorite(Request $request) {
        // 科目のidを取得
        $subjectId = $request->input('id');
        if (Auth::guard('student')->check()) {
            $studentId = Auth::guard('student')->id();
            $subjectFavorite = new Subject_Favorite;
            $subjectFavorite->student_id = $studentId;
            $subjectFavorite->y_subject_id = $subjectId;
            $subjectFavorite->save();        
        } elseif (Auth::guard('teacher')->check()) {
            $teacherId = Auth::guard('teacher')->id();
            $subjectFavorite = new Y_Subject_Favorite;
            $subjectFavorite->teacher_id = $teacherId;
            $subjectFavorite->y_subject_id = $subjectId;
            $subjectFavorite->save();        
        } else {
        }
        return redirect()->back();
        
    }

    // お気に入り削除
    // 余裕があったら
    public function deleteFavorite(Request $request) {
        $subjectId = $request->input('id');
        if (Auth::guard('student')->check()) {
            $studentId = Auth::guard('student')->id();
            Subject_Favorite::where('student_id',$studentId)->where('subject_id',$subjectId)->delete();     
        } elseif (Auth::guard('teacher')->check()) {
            $teacherId = Auth::guard('teacher')->id();
            Subject_Favorite::where('teacher_id',$teacherId)->where('subject_id',$subjectId)->delete();     
        } else {
        }
        return redirect()->back();
    }
}


