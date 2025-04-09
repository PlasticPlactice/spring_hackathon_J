<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>生徒情報登録</h2>
    <form action="students_add" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="from_page" value="{{$fromPage}}">
        <input type="file" name="csv_file" accept=".csv" >
        <input type="submit" value="送信">
    </form>
    <!-- エラー表示 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</body>
</html>