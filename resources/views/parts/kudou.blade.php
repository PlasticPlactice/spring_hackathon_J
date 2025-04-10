<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/all-style.css">
</head>
<body>
    <nav id="side-bar">
        <h1 id="app-name">ABCDE</h1>

        <ul>
            <li class="side-bar-menu-item" id="content-1" tabindex="0">
                サブメニュー
                <ul class="sub-menu">
                    <li><a href="#">AAAAA</a></li>
                    <li><a href="#">BBBBB</a></li>
                </ul>
            </li>

            <li class="side-bar-menu-item" id="content-2" tabindex="0">
                サブメニュー
                <ul class="sub-menu">
                    <li><a href="#">CCCCC</a></li>
                    <li><a href="#">DDDDD</a></li>
                </ul>
            </li>

            <li class="side-bar-menu-item" id="content-3" tabindex="0">
                サブメニュー
                <ul class="sub-menu">
                    <li><a href="#">EEEEE</a></li>
                    <li><a href="#">FFFFF</a></li>
                </ul>
            </li>
        </ul>

        <div id="user-section">
            <img src="https://picsum.photos/400/400" id="user-icon" title="ユーザーメニューを開く" tabindex="0">
            
            <div id="user-menu">
                <input type="file" id="user-icon-input" accept="image/*" style="display:none">

                <li><a href="#" id="user-icon-change">アイコン変更</a></li>
                <li><a href="#">パスワード変更</a></li>
                <li><a href="#" class="text-red">ログアウト</a></li>
            </div>
        </div>
    </nav>

    <script>
        var userIcon = document.getElementById("user-icon");
        var userMenu = document.getElementById("user-menu");
        var userSection = document.getElementById("user-section");
        var userIconChange = document.getElementById("user-icon-change");
        var userIconInput = document.getElementById("user-icon-input");
        var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

        // ユーザーアイコンクリック時
        userIcon.addEventListener("click", function () {
            if (userMenu.style.display === "block") {
                userMenu.style.display = "none";
                userIcon.style.border = "none";
            } else {
                userMenu.style.display = "block";
                userIcon.style.border = "3px solid var(--white)";
            }
        });

        // メニュー外クリックでメニューを閉じる
        document.addEventListener("click", function (event) {
            if (!userSection.contains(event.target)) {
                userMenu.style.display = "none";
                userIcon.style.border = "none";
            }
        });

        // 「アイコン変更」でファイル選択
        userIconChange.addEventListener("click", function (e) {
            e.preventDefault();
            userIconInput.click();
        });

        // // ファイル選択後の処理
        // userIconInput.addEventListener("change", function () {
        //     var file = this.files[0];
        //     if (!file) return;

        //     var formData = new FormData();
        //     formData.append("icon", file);

        //     fetch("/api/user/icon", {
        //         method: "POST",
        //         headers: {
        //             "X-CSRF-TOKEN": csrfTokenMeta.getAttribute("content")
        //         },
        //         body: formData
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.success && data.icon_url) {
        //             userIcon.src = data.icon_url;
        //             alert("アイコンを変更しました");
        //         } else {
        //             alert("アイコンのアップロードに失敗しました");
        //         }
        //     })
        //     .catch(error => {
        //         console.error("アップロードエラー:", error);
        //         alert("エラーが発生しました");
        //     });
        // });
    </script>
</body>
</html> -->

@extends('layouts.base')
@section('title','トップページです')
@section('sideer')
<li class="side-bar-menu-item" id="content-3" tabindex="0">
    サブメニュー
    <ul class="sub-menu">
        <li><a href="#">EEEEE</a></li>
        <li><a href="#">FFFFF</a></li>
    </ul>
</li> 
@endsection

@section('content')
<h1>aaaaaaaaaaaaaaaaaaa      Contentです</h1>
@endsection
