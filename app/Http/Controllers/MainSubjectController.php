<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\S_Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Y_Subject;
use App\Models\Course_list;



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
        // dd($Comments[0]);
        // サブ科目ページのidを取得
        $subjectIdList = Y_Subject::where('subject_id',$subject_id)->pluck('course_list_id')->toArray();; 

        // その中で最新サブ科目テーブルのidを取得
        $subSubjectId = Course_list::whereIn('id', $subjectIdList)->orderByDesc('year')
        ->orderByDesc('session_flg')
        ->value('id'); // ← 1件だけidを取得;
        // ->first(); // ← 1件だけidを取得;
        // dd($subSubjectId);



        return view('subject/subject_master' , ['item' => $item, 'comments' => $Comments, 'subject_id' => $subject_id, 'latestSubSubjectId'=>$subSubjectId]);
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
        dd($request->id);
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

        return redirect()->route('student.top');  
    }

    public function createComment(Request $request) {
        $subject_id = $request->y_subject_id;
        $student_id = Auth::guard('student')->id();
        $title = "";
        $detail = $request->text;
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
