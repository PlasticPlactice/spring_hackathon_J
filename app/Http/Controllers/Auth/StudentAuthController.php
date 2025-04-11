<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentEditRequest;
use App\Http\Requests\ChangePasswordRequest;
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
        if($student){
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
        }else{
            abort(Response::HTTP_NOT_FOUND, '学生データが見つかりません');      

        }
    }

    // 生徒データ編集処理
    public function update(StudentEditRequest $request,$id){
        // idを取得

        // 更新する学生データの取得
        $student = Student::find($id);
        if($student){

            
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
        }else{
            return back()->withErrors(['id' => '存在しない生徒情報です'])->withInput();
        }

        

    }

    

    // パスワード変更ページ表示
    public function passwordChangeShow(Request $request){
        return view('auth/password_change',['url'=>'student_password_change']);
    }
    // パスワード変更ページ表示
    public function passwordChange(ChangePasswordRequest $request){
         // 現在認証されている学生の情報を取得
        $student = Auth::guard('student')->user();

        // 送られてきた現在のパスワードと現在のパスワードが一致するかをチェック
        if (!Hash::check($request->current_password, $student->pw)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

          // ここで新しいパスワードの変更処理を実行
        $student->pw = Hash::make($request->new_password);
        $student->save();

        return redirect()->route('login');

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


    // 生徒情報削除処理
    public function delete(Request $request,$id){
        // 削除する学生データの取得
        $student = Student::find($id);

        if ($student) {
            // del_flgを更新
            $student->del_flg = true; // または 1; // 論理削除を示す値
            $student->save(); // 変更を保存

            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.top');
            }else{
                return redirect()->route('teacher.top');
            }
    
        } else {
            // 学生が見つからない場合の処理（例: エラーメッセージを表示）
            abort(Response::HTTP_NOT_FOUND, '存在しない生徒情報です');      
        }
    }

 
}
