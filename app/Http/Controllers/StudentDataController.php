<?php
namespace App\Http\Controllers;


use App\Http\Requests\StudentCsvUploadRequest;
use App\Http\Requests\StudnetRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Department;
use League\Csv\Reader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StudentDataController extends Controller
{
    // 生徒データ一覧ページ表示
    public function index(Request $request)
    {
        $students = Student::where('del_flg','0')->with('Department')->get();

        return view('admin/students_list', ['students' => $students]);
    }
    
    // 生徒データ登録ページ表示
    public function add(StudnetRegisterRequest $request)
    {
        $fromPage = $request->input('from_page');
        return view('auth/students_register',['fromPage' => $fromPage]);
    }

    // 生徒データ登録
    public function insert(StudentCsvUploadRequest $request)
    {
        // アップロードされたファイルを取得
        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        // CSVファイルを読み込む
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // ヘッダー行を無視

        // 列名を取得
        $headerData = $csv->getHeader();
        // 想定される列名を定義
        $headerLists = ['メールアドレス', '名前', '入学年度', '学科'];

        // 送信された列名が想定された列名かを確認
        foreach ($headerData as $item) {
            if (!in_array($item, $headerLists)) {
                return redirect()->back()->withErrors(['csv_file' => 'CSVの列名が正しくありません。'.$item])->withInput();
            }
        }

        // 学科情報を学科名をindexにして取得
        $departments = Department::pluck('id', 'name')->toArray();

         // csvデータを 配列にデータを格納
         $csvData = [];
         $studentData = Student::pluck('id')->toArray(); // データベースからメールアドレスを取得
         
         // CSVデータを配列に格納
         foreach ($csv as $row) {
             $csvData[] = [
                 'メールアドレス' => $row['メールアドレス'],
                 '名前' => $row['名前'],
                 '入学年度' => $row['入学年度'],
                 '学科' => $row['学科'],
             ];
         }
         
         // csvのルール
         $csvRules = [
             'csv_array.*.メールアドレス' => ['required', function ($attribute, $value, $fail) use ($studentData, $csvData) {
                 // 入力されたメールアドレスがすでにデータベースに存在するかを確認
                 if (in_array($value, $studentData)) {
                     $fail('メールアドレス「' . $value . '」はすでに登録されています。');
                 }
                 
                 // CSV内で重複するメールアドレスがあるか確認
                 $idCount = collect($csvData)->where('メールアドレス', $value)->count();
                 if ($idCount > 1) {
                     $fail('メールアドレス「' . $value . '」はCSVファイル内で重複しています。');
                 }
             }],
             'csv_array.*.名前' => ['required', 'string'],
             'csv_array.*.入学年度' => ['required', 'digits:4', 'integer'],
             'csv_array.*.学科' => ['required', 'string', function ($attribute, $value, $fail) use ($departments) {
                 // 学科名が存在するかどうかチェック
                 if (!array_key_exists($value, $departments)) {
                     $fail('学科名「' . $value . '」は存在しません。');
                 }
             }],
         ];
         
         $customMessages = [
             'csv_array.*.メールアドレス.required' => 'メールアドレスが空のデータがあります。',
             'csv_array.*.名前.required' => '名前が空のデータがあります。',
             'csv_array.*.入学年度.required' => '入学年度が空のデータがあります。',
             'csv_array.*.入学年度.digits' => '入学年度は4桁で入力してください。',
             'csv_array.*.入学年度.integer' => '入学年度は数字で入力してください。',
             'csv_array.*.学科.required' => '学科が空のデータがあります。',
         ];
         
         // バリデーション実行
         $validator = Validator::make(
             ['csv_array' => $csvData], // csvDataにCSVから読み取った配列が格納されていると仮定
             $csvRules,
             $customMessages
         );
         
         // バリデーション結果
         if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $uniqueErrors = array_unique($errors); // 重複を削除
            return redirect()->back()->withErrors($uniqueErrors)->withInput();   
        }
    
        // エラーがない場合、データベースに登録
        foreach ($csvData as $row) {
            // 学科のIDを取得
            $department_id = $departments[$row['学科']];            

            // Studentの新しいインスタンスを作成
            $student = new Student();

            // 学生データを$studentオブジェクトにセット
            $student->email = $row['メールアドレス'];
            $student->pw = Hash::make('morijyobi'); // パスワードをハッシュ化
            $student->name = $row['名前'];
            $student->img_path = ''; // 画像のパス（必要に応じて変更）
            $student->entrance_year = $row['入学年度'];
            $student->department_id = $department_id;

            // 学生データを保存
            $student->save();
        }
        // 遷移先情報を取得
        $fromPage = $request->input('from_page');
        if($fromPage === 'teacher'){
            return redirect()->route('teacher.top')->with('success', '生徒データが正常に登録されました。');
        }else{
            return redirect()->route('admin.top')->with('success', '生徒データが正常に登録されました。');
        }

        // すべてのデータが正常に登録された場合、成功メッセージを表示
    }
}
