<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TeacherCsvUploadRequest;
use App\Models\Teacher;
use League\Csv\Reader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{
    // 教師データ登録ページ表示
    public function add(Request $request){
        return view('auth/teachers_register');
    }
    // 教師データ登録処理
    public function insert(TeacherCsvUploadRequest $request){
         // アップロードされたファイルを取得
         $file = $request->file('csv_file');
         $path = $file->getRealPath();
 
         // CSVファイルを読み込む
         $csv = Reader::createFromPath($path, 'r');
         $csv->setHeaderOffset(0); // ヘッダー行を無視
 
         // 列名を取得
         $headerData = $csv->getHeader();
         // 想定される列名を定義
         $headerLists = ['メールアドレス', '名前'];
 
         // 送信された列名が想定された列名かを確認
         foreach ($headerData as $item) {
             if (!in_array($item, $headerLists)) {
                 return redirect()->back()->withErrors(['csv_file' => 'CSVの列名が正しくありません。'.$item])->withInput();
             }
         }
 
  
 
          // csvデータを 配列にデータを格納
          $csvData = [];
          $teacherData = Teacher::pluck('id')->toArray(); // データベースからメールアドレスを取得
          
          // CSVデータを配列に格納
          foreach ($csv as $row) {
              $csvData[] = [
                  'メールアドレス' => $row['メールアドレス'],
                  '名前' => $row['名前'],
              ];
          }


          // csvのルール
          $csvRules = [
              'csv_array.*.メールアドレス' => ['required', function ($attribute, $value, $fail) use ($teacherData, $csvData) {
                  // 入力されたメールアドレスがすでにデータベースに存在するかを確認
                  if (in_array($value, $teacherData)) {
                      $fail('メールアドレス「' . $value . '」はすでに登録されています。');
                  }
                  
                  // CSV内で重複するメールアドレスがあるか確認
                  $idCount = collect($csvData)->where('メールアドレス', $value)->count();
                  if ($idCount > 1) {
          
                      $fail('メールアドレス「' . $value . '」はCSVファイル内で重複しています。');
                  }
              }],
              'csv_array.*.名前' => ['required', 'string'],
          ];
          
          $customMessages = [
              'csv_array.*.メールアドレス.required' => 'メールアドレスが空のデータがあります。',
              'csv_array.*.名前.required' => '名前が空のデータがあります。',
          ];
          
          // バリデーション実行
          $validator = Validator::make(
              ['csv_array' => $csvData], 
              $csvRules,
              $customMessages
          );

          
          
          // バリデーション結果
          if ($validator->fails()) {
             // エラーを一意にする
             $errors = $validator->errors()->all();
             $uniqueErrors = array_unique($errors); // 重複を削除
              return redirect()->back()->withErrors($uniqueErrors)->withInput();
          }
     
         // エラーがない場合、データベースに登録
         foreach ($csvData as $row) {

             // Teacherの新しいインスタンスを作成
             $teacher = new Teacher();
 
             $teacher->id = $row['メールアドレス'];
             $teacher->pw = Hash::make('morijyobi'); // パスワードをハッシュ化
             $teacher->name = $row['名前'];

             // 学生データを保存
             $teacher->save();
         }
             return redirect()->route('admin.top')->with('success', '生徒データが正常に登録されました。');
    }

    // 教師データ編集・削除ページ表示
    public function edit(Request $request){
        return view('auth/teachers_edit');
    }

    // パスワード変更ページ表示
    public function passwordChange(Request $request){
        return view('auth/password_change');
    }

    // ログイン処理
    public function login(LoginRequest $request){

        // idとパスワードを取得
        $userData = $request->only('id', 'pw');
        $userData['password'] = $userData['pw'];
        unset($userData['pw']);

         
        // Authによる認証を行う
        if (Auth::guard('teacher')->attempt($userData)) {
            return redirect()->route('teacher.top');  // 認証成功時のリダイレクト先
        }

        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }
}
