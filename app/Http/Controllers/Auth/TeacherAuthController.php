<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TeacherCsvUploadRequest;
use App\Http\Requests\TeacherEditRequest;
use App\Models\Teacher;
use League\Csv\Reader;
use App\Http\Requests\ChangePasswordRequest;
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
 
             $teacher->email = $row['メールアドレス'];
             $teacher->pw = Hash::make('morijyobi'); // パスワードをハッシュ化
             $teacher->name = $row['名前'];

             // 教師データを保存
             $teacher->save();
         }
             return redirect()->route('admin.top')->with('success', '生徒データが正常に登録されました。');
    }

    // 教師データ編集・削除ページ表示
    public function edit(Request $request,$id){
        // データベースから教師情報を取得
        $teacher = Teacher::find($id);
        if($teacher){
            return view('auth/teachers_edit',['teacher' => $teacher]);
        }else{
            abort(Response::HTTP_NOT_FOUND, '教師データが見つかりません');      
        }
    }
    // 教師データ編集処理
    public function update(TeacherEditRequest $request,$id){
        // データベースから教師情報を取得
        $teacher = Teacher::find($id);

        if($teacher){

            // 送信されたデータを格納
            $teacher->name = $request->input('name');

            
            // パスワードリセットの場合
            if ($request->has('password_reset')) {
                $teacher->pw =  Hash::make('morijyobi');
            } 

            // データベースに保存
            $teacher->save();

            return redirect('/teacher_edit/'.$id);  // 認証成功時のリダイレクト先
        }else{
            return back()->withErrors(['id' => '存在しない教師情報です'])->withInput();
        }


    }

     // パスワード変更ページ表示
     public function passwordChangeShow(Request $request){
        return view('auth/password_change',['url'=>'teacher_password_change']);
    }
    // パスワード変更ページ表示
    public function passwordChange(ChangePasswordRequest $request){
         // 現在認証されている学生の情報を取得
        $teacher = Auth::guard('teacher')->user();

        // 送られてきた現在のパスワードと現在のパスワードが一致するかをチェック
        if (!Hash::check($request->current_password, $teacher->pw)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

          // ここで新しいパスワードの変更処理を実行
        $teacher->pw = Hash::make($request->new_password);
        $teacher->save();

        return redirect()->route('login');

    }

    

    // ログイン処理
    public function login(LoginRequest $request){

        // id(メールアドレス)とパスワードを取得
        $userData = $request->only('id', 'pw');
        $userData['password'] = $userData['pw'];
        $userData['email'] = $userData['id'];
        unset($userData['pw']);
        unset($userData['id']);

         
        // Authによる認証を行う
        if (Auth::guard('teacher')->attempt($userData)) {
            return redirect()->route('teacher.top');  // 認証成功時のリダイレクト先
        }

        return back()->withErrors(['id' => 'idとパスワードが一致しません'])->withInput();
    }
    
    // 教師情報削除処理
    public function delete(Request $request,$id){
        // 削除する教師データの取得
        $teacher = Teacher::find($id);

        if ($teacher) {
            // del_flgを更新
            $teacher->del_flg = true; // または 1; // 論理削除を示す値
            $teacher->save(); // 変更を保存

            return redirect()->route('admin.top');
        } else {
            // 教師が見つからない場合の処理（例: エラーメッセージを表示）
            abort(Response::HTTP_NOT_FOUND, '存在しない生徒情報です');      
        }
    }
    
    
}
