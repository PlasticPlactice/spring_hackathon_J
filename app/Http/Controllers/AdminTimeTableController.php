<?php

namespace App\Http\Controllers;

use App\Models\Course_list;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Y_Subject;
use App\Models\Time_Table;


class AdminTimeTableController extends Controller
{
    // 時間割登録ページを表示する
    public function index(Request $request){
        
        // 表示する時期を取得する
        $year = intval($request->input('year'));  // 数字に変換
        $sessionFlg = intval($request->input('session_flg'));  // 数字に変換

        // 年度を計算
        $currentYear = Carbon::now()->year;
        $years = [];
        for ($i = -5; $i <= 5; $i++) {
            $years[] = $currentYear + $i;
        }


        // データベースから現在登録されている時間割データを取得
        $timeTables = null;  // 変数の初期化
        if ($year && ($sessionFlg === 1 || $sessionFlg === 0)) {
            \DB::enableQueryLog();  // 
            $timeTables = Time_Table::whereHas('courseList' ,function($query) use ($year, $sessionFlg) {
                $query->where('year','=' , $year)  // yearを指定
                    ->where('session_flg', '=' ,$sessionFlg);  // session_flgを指定
                })->with('courseList')->get();
            
            $jsonData = [
                'year' => $year,
                'session_flg' => $sessionFlg,
                'table' =>[]
            ]; 
            for ($i = 1; $i <= 4; $i++) {
                for ($j = 1; $j <= 5; $j++) {
                    $jsonData['table'][$i][$j] = [];
                }
            }
            
            // json配列に現在登録されている情報を格納
            foreach ($timeTables as  $value) {
                $dayOfWeek = $value->day_of_week;
                $frames = $value->frames;
                $jsonData['table'][$frames][$dayOfWeek][] = ['id' => $value->courseList->id,'title' => $value->courseList->title];
            }
            
            // データベースから履修科目情報を取得
            $courseList = Course_list::where('year','=' , $year)  
            ->where('session_flg', '=' ,$sessionFlg)->get();
                    
            return view('admin/timetable_register',['years' => $years,'jsonData'=>$jsonData,'courseList' => $courseList]);
        }else{
            return view('admin/timetable_register',['years' => $years]);
        }

      

    }

    
    // 今季の時間割を登録する処理
    public function insert(Request $request){
        // 送信されてたデータを連想配列で取得    
        $extraJson = $request->input('sendData');
        $sendData = json_decode($extraJson, true); // 第2引数 true で連想配列として取得

        $year = $sendData['year'];
        $session_flg = $sendData['session_flg'];
        $addData = $sendData['addData'];
        $delData = $sendData['delData'];

        // データベースに登録処理
       for($i = 1; $i < 5; $i++){
           for($j = 1; $j < 6; $j++){
                if (!empty($addData[$i][$j])) {
                    foreach($addData[$i][$j] as $id){
                        $timeTable = new Time_Table;
                        $timeTable->course_list_id = $id;
                        $timeTable->frames = $i;
                        $timeTable->day_of_week = $j;
                        $timeTable->save();
                    }
                }
           }
       }
        // データベースから削除
       for($i = 1; $i < 5; $i++){
           for($j = 1; $j < 6; $j++){
                if (!empty($delData[$i][$j])) {
                    foreach($delData[$i][$j] as $id){
                        $timeTable =Time_Table::where('course_list_id',$id)
                        ->where('frames',$i)
                        ->where('day_of_week',$j)->first()->delete();
                    }
                }
           }
       }

        // 時間割登録ページにリダイレクト    
        return redirect('/timetable_register?year=' . $year . '&session_flg=' . $session_flg);


    }
    
    // 今季履修可能科目登録ページを表示
    public function addTimeTable(Request $request){
        $teachers = Teacher::all();
        $subjects = Subject::all();

        return view('admin/available_subject_register' , ["teachers" => $teachers, "subjects" => $subjects]);
    }

    // 今期履修可能科目登録
    // 登録した場合サブページ(y_subjects)にも自動で登録されるようにする
    // 登録画面でsubjectsの科目名を選択させてそのidをsubject_id
    // 登録された最新のcourse_listのidをcourse_list_idとしてy_subjectsに登録する
    public function createTimeTable(Request $request) {

        // Course_listに登録
        Course_list::createCourseList(
            $request->teacher_id,
            $request->title,
            $request->year,
            $request->session_flg
        );

        // 現時点で最新のCourse_list_idを取得
        $latestId = Course_list::orderBy('created_at', 'desc')->value('id');

        // y_subjects登録処理
        Y_Subject::createYSubject(
            $latestId,
            $request->subject_id,
            $request->detail
        );

        return redirect('/admin_top');
    }

    // 今期履修可能科目編集・削除ページを表示
    public function editTimeTable(Request $request){
        $form = DB::table('course_lists')
        ->where('id', $request->id)
        ->first();

        
        return view('admin/available_subject_edit', ['form' => $form]);
    }

    // 今期履修科目登録の編集処理
    public function updateOrdeleteTimeTable(Request $request) {

        if($request->action === 'update') {
            $data = [
                'teacher_id' => $request->teacher_id,
                'title' => $request->title,
                'year' => $request->year,
                'session_flg' => $request->session_flg,
            ];

            // モデルのメソッドを使ってデータを更新
            Course_list::updateCourseList($request->id, $data);
        } elseif($request->action === 'delete') {
            Y_Subject::deleteYSubject($request->id);
            Course_list::deleteCourseList($request->id);
        }

        return view('admin/admin_top');
    }
}
