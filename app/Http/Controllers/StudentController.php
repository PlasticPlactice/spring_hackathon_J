<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Course_list;
use App\Models\C_Subject;
use App\Models\Time_Table;
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

        return view('student/student_top', ['timeTables' => $timeTableGrid, 'days' => $days]);
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
        return redirect()->route('student.top');  
        
    }
    // 個別時間割編集ページ表示
    public function editTimeTable(Request $request){
        return view('student/personal_timetable_edit');
    }
    
}


