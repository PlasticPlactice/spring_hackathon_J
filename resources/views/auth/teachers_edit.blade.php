<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>教師データ編集・削除</h2>
    <form action="/teacher_update/{{$teacher->id}}" method="post">
        @csrf
        id: <sapn>{{$teacher->email}}</sapn>
        パスワードリセット:<input type="checkbox" name="password_reset" value="1">
        名前 <input type="text" name="name" value="{{$teacher->name}}">

        <input type="submit" value="更新">
    </form>

    <!-- バリデーションエラーの一覧表示 -->
    @if ($errors->any())
        <div>
            <h4>入力エラーがあります:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>