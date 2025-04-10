<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link rel="stylesheet" href="/css/all-style.css">
</head>
<body>
    <div>ID:<input type="text" name="id" placeholder="ユーザIDを入力" class="input"></div>
    <div>パスワード：<input type="password" name="password" placeholder="パスワードを入力" class="pass"></div>
    <div>パスワード：<input type="checkbox" name="check" class="check">リセットする</div>
    <div><input type="text"></div>
    <div>
        <label for="large">ラベル：</label>
        <textarea name="large" class="large"></textarea>
    </div>
    <select name="select" id="select">
        <option value="0">管理者</option>
        <option value="1">教師</option>
        <option value="2">生徒</option>
    </select>
    <button>検索</button>
    <div id="subject-side-menu">
        <ul>
            <li><input type="text" name="subject" placeholder="科目名で検索" id="subject"></li>
            <li id="subject-return">＜戻る</li>
            <li>Python基礎</li>
            <li>Python応用<br>(tkinter)</li>
            <li>html,css<br>基礎</li>
            <li>JavaScript<br>基礎</li>
            <li>Java基礎</li>
            <li>C#基礎基礎</li>
        </ul>
    </div>
        
        <span id="subject-side-button" class="material-symbols-outlined">
    menu
    </span>
    <script>
        document.getElementById('subject-side-button').addEventListener('click', function() {
        document.getElementById('subject-side-menu').classList.toggle('active');
        });
        document.getElementById('subject-return').addEventListener('click', function() {
        document.getElementById('subject-side-menu').classList.toggle('active');
        });
    </script>
</body>
</html>