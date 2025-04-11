<!-- @extends('layouts.base')

@section('title','テストページ')

@section('external_css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=send" />
@endsection

@section('side_bar_content')
    @component('components.side_bar_menu')
        @slot('content_id')
            1
        @endslot

        @slot('side_bar_menu')
            サブメニューあり
        @endslot

        @slot('register_link')
            https://www.google.co.jp/
        @endslot

        @slot('edit_link')
            https://www.yahoo.co.jp/
        @endslot
    @endcomponent

    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="https://www.yahoo.co.jp/">サブメニュー無し<br>直接リンク</a>    
    </li>

    @component('components.side_bar_menu')
        @slot('content_id')
            3
        @endslot

        @slot('side_bar_menu')
            サブメニューあり(2)
        @endslot

        @slot('register_link')
            https://www.google.co.jp/
        @endslot

        @slot('edit_link')
            https://www.yahoo.co.jp/
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.comment')
    @endcomponent
@endsection

@section('js')
    <script src="/js/comment.js"></script>
@endsection -->



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パーツごとのページ</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=send" />
    <link rel="stylesheet" href="/css/all-style.css">
</head>
<body>
<!-- ページタグ -->
    <!-- <header id="page-tab">
        <h2>概要</h2>
        <h2>授業記録</h2>
    </header> -->

<!-- ボタン系 -->
    <!-- <button id="insert-button">登録</button>
    <button id="update-button">更新</button>
    <button id="update-button">変更</button>
    <button id="delete-button">削除</button>
    <button id="accountdel-button">アカウント削除</button>
    <button id="edit-button">編集</button>
    <button id="search-button">検索</button>
    <button id="choose-button">ファイルを選択</button>
    <button id="login-button">ログイン</button> -->

<!-- フォーム -->
    <!-- <form>
        <input type="text" name="textbox">
    </form> -->

<!-- コメント欄（コメントのみ） -->
    <!-- <div class="section-title">
        <h2>生徒からのコメント</h2>
    </div>
    <form class="comments">
        <div class="comment-container">
            <textarea type="text "id="comment-input" placeholder="コメントを入力する"></textarea>
            <button type="submit" class="material-symbols-outlined send-button">send</button>
        </div>
    </form> -->

<!-- コメント欄（添付、リンクあり） -->
    <!-- <form class="comments">
        <div class="comment-container">
            <textarea type="text "id="comment-input" placeholder="コメントを入力する"></textarea>
            <button type="submit" class="material-symbols-outlined send-button">send</button>
        </div>
    </form> -->

<!-- コメント -->
    <div class="comment-box">
        <div class="comment">
            <img src="avatar.png" alt="satoのアバター" class="avatar">
            <div class="comment-content">
                <p class="username">sato</p>
                <p class="date">2025/1/1</p>
                <p class="text">授業の内容が分かりやすい</p>
            </div>
        </div>
    </div>

    <script>
---投稿ボタンの色変化---
        document.getElementById("comment-input").addEventListener("input", function() {
    const commentInput = document.getElementById("comment-input");
    const sendButton = document.querySelector(".send-button");

    if (commentInput.value.trim() !== "") {
        sendButton.style.color = "var(--main-color)";
        sendButton.style.cursor = "pointer";
        sendButton.classList.add("active");
    } else {
        sendButton.style.color = "var(--light-gray)";
        sendButton.style.cursor = "default";
        sendButton.classList.remove("active");
    }
});

---ページタブ---
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll("#page-tab h2");

  tabs.forEach(tab => {
    tab.addEventListener("click", function () {
      tabs.forEach(t => t.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
    </script>
</body>
</html>