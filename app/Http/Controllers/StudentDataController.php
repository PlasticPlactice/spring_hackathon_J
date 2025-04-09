<?php
namespace App\Http\Controllers;


use App\Http\Requests\CsvUploadRequest;
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
        return view('admin/students_list');
    }
    
    // 生徒データ登録ページ表示
    public function add(StudnetRegisterRequest $request)
    {
        $fromPage = $request->input('from_page');
        return view('auth/students_register',['fromPage' => $fromPage]);
    }

    // 生徒データ登録
    public function insert(CsvUploadRequest $request)
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
                return redirect()->back()->withErrors(['csv_file' => 'CSVの列が正しくありません。'.$item])->withInput();
            }
        }

        // 学科情報を学科名をindexにして取得
        $departments = Department::pluck('id', 'name')->toArray();

        // csvのルール
        $csvRules = [
            'メールアドレス' => 'required',
            '名前' => 'required',
            '入学年度' => 'required|digits:4|integer',
            '学科' => 'required', // クロージャを後で合成
        ];

        $customMessages = [
            'メールアドレス.required' => 'IDは必須項目です。',
            '名前.required' => '名前は必須項目です。',
            '入学年度.required' => '入学年度は必須項目です。',
            '入学年度.digits' => '入学年度は4桁で入力してください。',
            '入学年度.integer' => '入学年度は数字で入力してください。',
            '学科.required' => '学科は必須項目です。',
        ];

        // バリデーションルールに学科のクロージャを追加
        $rules = $csvRules;
        $rules['学科'] = [
            'required',
            function ($attribute, $value, $fail) use ($departments) {
                if (!array_key_exists($value, $departments)) {
                    $fail('学科名「' . $value . '」は存在しません。');
                }
            },
        ];

        // csvからデータを取得し、バリデーションを実行
        $errors = [];
        // Stuentのidの一覧を取得
        $studentIds = Student::pluck('id')->toArray();
        foreach ($csv as $index => $row) {
            $validator = Validator::make($row, $rules, $customMessages);

            if ($validator->fails()) {
                // バリデーションエラーがある場合はエラー内容を格納
                $errors[] = $validator->errors()->all();
            }
            // メールアドレスに被りがあるかを確認
            if (!in_array($row['メールアドレス'], $studentIds)){
                $studentIds[] = $row['メールアドレス'];
            }else{
                return redirect()->back()->withErrors(['メールアドレス' => $row['メールアドレス'].'が重複しています'])->withInput();
            }
        }

        // エラーがあれば処理を中断して、エラーメッセージを返す
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // エラーがない場合、データベースに登録
        foreach ($csv as $row) {
            // 学科のIDを取得
            $department_id = $departments[$row['学科']];            

            // Studentの新しいインスタンスを作成
            $student = new Student();

            // 学生データを$studentオブジェクトにセット
            $student->id = $row['メールアドレス'];
            $student->pw = Hash::make('morijyobi'); // パスワードをハッシュ化
            $student->name = $row['名前'];
            $student->img_path = ''; // 画像のパス（必要に応じて変更）
            $student->entrance_year = $row['入学年度'];
            $student->department_id = $department_id;

            // 学生データを保存
            $student->save();
        }

        // すべてのデータが正常に登録された場合、成功メッセージを表示
        return redirect()->route('student.top')->with('success', '生徒データが正常に登録されました。');
    }
}
