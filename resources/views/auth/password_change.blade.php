<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <!-- バリデーションエラーの一覧表示 -->
      @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{$url}}" method="post">
        @csrf
    <div>
        <label>現在のパスワード</label>
        <input type="password" name="current_password" >
    </div>

    <div>
        <label>新しいパスワード</label>
        <input type="password" name="new_password" >
    </div>

    <div>
        <label>パスワード確認</label>
        <input type="password" name="new_password_confirmation" >
    </div>
    <input type="submit" value="送信">
    </form>
</body>
</html>