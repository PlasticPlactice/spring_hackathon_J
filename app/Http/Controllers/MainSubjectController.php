<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\S_Comment;
use Illuminate\Support\Facades\Auth;

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

        $subject_id = $request->id;

        $Comments = S_Comment::with('Student')->where('subject_id', $item->id)->get();

        return view('subject/subject_master' , ['item' => $item, 'comments' => $Comments, 'subject_id' => $subject_id]);
    }
    
    // 科目マスターページ登録表示
    public function add(Request $request){
        return view('/subject/subject_master_register');
    }

    // 科目ページ登録処理
    public function create(Request $request) {

        // Subjectsに登録
        Subject::CreateSubject(
            $request->name,
            $request->detail,
            $request->tech
        );

        return view('/subject/subject_master_register');
        }

    // 科目マスターページ編集・削除表示
    public function edit(Request $request){
        $item = DB::table('subjects')
        ->where('id', $request->id)
        ->first();

        return view('subject/subject_master_edit', ['form' => $item]);
    }

    // 更新の処理
    // ※削除はなし
    public function updateOrDelete(Request $request) {
        // 更新
        $data = [
            'name' => $request->name,
            'detail' => $request->detail,
            'tech' => $request->tech,
        ];
        Subject::updateSubject($request->id, $data);

        return redirect('/admin_top');
    }

    public function createComment(Request $request) {
        $subject_id = $request->subject_id;
        $student_id = Auth::guard('student')->id();
        $title = $request->title;
        $detail = $request->detail;
        S_Comment::CreateSComment($subject_id, $student_id, $title, $detail);

        return redirect('/subject_master/'.$subject_id);
    }

    // 科目名の曖昧検索
    public function search(Request $request){
        $text = $request->input('text');
        $items = Subject::where('name', 'like', '%'.$text.'%')->get();
        return view('subject/subjects_master_list', ['items' => $items]);
    }
}
