<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    教師データ一覧
    <table>
        @foreach ($teachers as $teacher)
        <tr>
            <td>id</td>
            <td>{{$teacher->email}}</td>
        </tr>
        <tr>
            <td>名前</td>
            <td>{{$teacher->name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>