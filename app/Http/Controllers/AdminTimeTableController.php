<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    // 今季履修科の科目編集・削除ページを表示
    public function editTimeTable(Request $request){
        return view('admin/available_subject_edit');
    }

}
