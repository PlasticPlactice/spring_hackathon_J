<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>生徒データ編集・削除</h2>
    <form action="/students_update/{{$student->id}}" method="post" enctype="multipart/form-data">
        @csrf
        id: <sapn>{{$student->email}}</sapn>
        パスワードリセット:<input type="checkbox" name="password_reset" value="1">
        名前 <input type="text" name="name" value="{{$student->name}}">
        画像 <input type="file" name="img_data">
        <img  src="{{ asset($student->img_path) }}" alt="アイコン画像">
        <br>
        学科:
        <select name="department" id="">
         @foreach($department as $item)                       
            <option value="{{ $item->id }}"  @if($item->id === $student->department->id)  selected  @endif>{{ $item->name }}</option>
        @endforeach
        </select>
        入学年度:
        <select name="entrance_year" id="">
        @foreach($years as $year)
            <option value="{{$year}}" @if($year === $student->entrance_year)  selected  @endif >{{$year}}</option>
        @endforeach
        </select>
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