<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="/css/shibaya_style.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <p class="app-name">abcde</p>
    <form action="login" method="post" id="loginform">
        <select name="権限" id="role">
            <option value="admin">管理者</option>
            <option value="teacher">教師</option>
            <option value="student">生徒</option>
        </select>
        @csrf
          <!-- idのエラーメッセージ -->
        @error('id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="id">ユーザID：</label>
            <input type="text" name="id" value="{{old('id')}}" class="text-input" placeholder="ユーザIDを入力">
        </div>
        <!-- パスワードのエラーメッセージ -->
        @error('pw')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="pw">パスワード：</label>
            <input type="password" name="pw" class="text-input" placeholder="パスワードを入力">
        </div>
        <input type="submit" value="ログイン" class="main-button" id="login-button">
    </form>
</body>
<script src="/js/login.js"></script>
</html>