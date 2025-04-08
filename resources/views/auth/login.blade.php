<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
    <h2>生徒</h2>
    <form action="student_login" method="post">
        @csrf
          <!-- idのエラーメッセージ -->
        @error('id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        id: <input type="text" name="id" value="{{old('id')}}" >
        <!-- パスワードのエラーメッセージ -->
        @error('pw')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        pw <input type="password" name="pw" >
        <input type="submit" value="送信">
    </form>



    <h2>教師</h2>
    <form action="teacher_login" method="post">
        @csrf
        id: <input type="text" name="id" >
        pw <input type="password" name="pw" >
        <input type="submit" value="送信">
    </form>
    <h2>管理者</h2>
    <form action="admin_login" method="post">
        @csrf
        id: <input type="text" name="id" >
        pw <input type="password" name="pw" >
        <input type="submit" value="送信">
    </form>
</body>
</html>