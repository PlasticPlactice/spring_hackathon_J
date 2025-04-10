<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;

class MainSubjectController extends Controller
{
    // 科目マスタページ一覧表示
    public function index(Request $request){
        $items = Subject::all();

        return view('subject/subjects_master_list', ['items' => $items]);
    }

    // 科目マスターページ表示
    public function show(Request $request){
        $item = DB::table('subjects')
        ->where('id', $request->id)
        ->first();
        return view('subject/subject_master' , ['item' => $item]);
    }
    
    // 科目マスターページ登録表示
    public function add(Request $request){
        return view('subject/subject_master_register');
    }

    // 科目ページ登録処理
    // Subjectsが作成されるとマスタ科目の詳細が作成されて
    public function create(Request $request) {

        $params = [
            'name' => $request->name,
            'detail' => $request->detail,
            'tech' => $request->tech
        ];

        DB::table('subjects')->insert($params);

        return view('subject/subject_master_register');
    }

    // 科目マスターページ編集・削除表示
    public function edit(Request $request){
        $item = DB::table('subjects')
        ->where('id', $request->id)
        ->first();

        return view('subject/subject_master_edit', ['form' => $item]);
    }

    // 更新または削除の処理
    public function updateOrDelete(Request $request) {
        if($request->action === 'update') {
            DB::table('subjects')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'detail' => $request->detail,
                'tech' => $request->tech,
            ]);
        } else if($request->action === 'delete') {
            DB::table('subjects')
            ->where('id', $request->id)
            ->delete();
        }
        
        return view('subject/subject_master');
    }
}
