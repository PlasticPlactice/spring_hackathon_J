<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainSubjectController extends Controller
{
    // 科目マスタページ一覧表示
    public function index(Request $request){
        return view('subject/subjects_master_list');
    }

    // 科目マスターページ表示
    public function show(Request $request){
        return view('subject/subject_master');
    }
    
    // 科目マスターページ登録表示
    public function add(Request $request){
        return view('subject/subject_master_register');
    }
    // 科目マスターページ編集・削除表示
    public function edit(Request $request){
        return view('subject/subject_master_edit');
    }

    
}
