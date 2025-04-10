<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentEditRequest;
use App\Models\Student;
use App\Models\department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class StudentAuthController extends Controller
{
    // 生徒データ編集・削除ページ表示
    public function edit(Request $request,$id){
        // データベースから生徒情報を取得
        $student = Student::with(['department'])
        ->where('id', $id)  
        ->first(); 
        // 学科情報を取得
        $department = department::all();
          // 現在の年を取得
        $currentYear = Carbon::now()->year;

        // 5年前から5年後までの年を配列に格納
        $years = [];
        for ($i = -5; $i <= 5; $i++) {
            $years[] = $currentYear + $i;
        }

        return view('auth/students_edit',['student' => $student,'department' => $department, 'years' => $years]);
    }

    // 生徒データ編集処理
    public function update(StudentEditRequest $request,$id){
        // idを取得

        // 更新する学生データの取得
        $student = Student::find($id);

        
        // 入力されたデータを更新
        $student->name = $request->input('name');
        $student->department_id = $request->input('department');
        $student->entrance_year = $request->input('entrance_year');


         // パスワードリセットの場合
         if ($request->has('password_reset')) {
            $student->pw =  Hash::make('morijyobi');
        } 

        // 画像の保存
        if (!is_null($request->file('img_data'))) {
            // ディレクトリ名
            $dir = 'img';
        
            // アップロードされたファイルの拡張子を取得
            $extension = $request->file('img_data')->getClientOriginalExtension();
        
            // ランダムなファイル名を生成（タイムスタンプ + ランダム文字列）
            $file_name = time() . '_' . Str::random(10) . '.' . $extension;
        
            // 取得したファイル名で保存
            $request->file('img_data')->storeAs('public/' . $dir, $file_name);
        
            // データベースに保存するパス
            $student->img_path = 'storage/' . $dir . '/' . $file_name;
        }

        // データベースに保存
        $student->save();

        return redirect('/student_edit/'.$id);  // 認証成功時のリダイレクト先

        

    }

    

    // パスワード変更ページ表示
    public function passwordChange(Request $request){
        return view('auth/password_change');
    }



    // ログイン処理
    public function login(LoginRequest $request){

        // id(email)とパスワードを取得
        $userData = $request->only('id', 'pw');
        $userData['password'] = $userData['pw'];
        $userData['email'] = $userData['id'];
        unset($userData['pw']);
        unset($userData['id']);

         
        // Authによる認証を行う
        if (Auth::guard('student')->attempt($userData)) {
            return redirect()->route('student.top');  // 認証成功時のリダイレクト先
        }

        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }

    
}
