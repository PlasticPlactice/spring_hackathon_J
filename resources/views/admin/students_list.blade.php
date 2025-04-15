<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    生徒データ一覧画面
    <table>
        @foreach ($students as $student)
        <tr>
            <td><img src="{{ asset($student->img_path) }}" alt="アイコン画像" style="width: 20px; height: 20px;"></td>
        </tr>
        <tr>
            <td>id</td>
            <td>{{$student->email}}</td>
        </tr>
        <tr>
            <td>名前</td>
            <td>{{$student->name}}</td>
        </tr>
        <tr>
            <td>入学年度</td>
            <td>{{$student->entrance_year}}</td>
        </tr>
        <tr>
            <td>学部</td>
            <td>{{$student->Department->name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>