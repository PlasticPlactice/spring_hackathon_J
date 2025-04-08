<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTimeTableController extends Controller
{
    // 時間割登録ページを表示する
    public function index(Request $request){
        return view('admin/timetable_register');
    }
    // 今季履修科の科目登録ページを表示
    public function addTimeTable(Request $request){
        return view('admin/available_subject_register');
    }

    // 今期履修可能科目登録
    public function createTimeTable(Request $request) {

        $params = [
            'teacher_id' => $request->teacher_id,
            'title' => $request->title,
            'year' => $request->year,
            'session_flg' => $request->session_flg
        ];

        DB::table('course_lists')->insert($params);

        return view('admin/available_subject_register');
    }

    // 今季履修科の科目編集・削除ページを表示
    public function editTimeTable(Request $request){
        $form = DB::table('course_lists')
        ->where('id', $request->id)
        ->first();

        return view('admin/available_subject_edit', ['form' => $form]);
    }

    // 今期履修科目登録の編集処理
    public function updateOrdeleteTimeTable(Request $request) {

        if($request->action === 'update') {
            DB::table('course_lists')
            ->where('id', $request->id)
            ->update([
                'teacher_id' => $request->teacher_id,
                'title' => $request->title,
                'year' => $request->year,
                'session_flg' => $request->session_flg,
            ]);
        } elseif($request->action === 'delete') {
            DB::table('course_lists')->where('id', $request->id)->delete();
        }

        return view('admin/admin_top');
    }

    // 今期履修可能科目の削除処理
    // public function deleteTimeTable(Request $request) {
    //     DB::table('course_lists')
    //     ->where('id', $request->id)
    //     ->delete();

    //     return view('admin/admin_top');
    // }

}
