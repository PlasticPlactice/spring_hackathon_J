@extends('layouts.base')
@section('title','まとめサブページ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_horiz" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=send" />
    <link rel="stylesheet" href="{{asset('css/shibaya_style.css')}}">
@endsection
    
@section('side_bar_content')
    <li class=side-bar-item id="content-1" tabindex="0">
        <a href="#">科目マスターページ一覧</a>
    </li>
    <li class=side-bar-item id="content-1" tabindex="0">
        <a href="#">科目ページ</a>
    </li>
    <li class=side-bar-item id="content-1" tabindex="0">
        <a href="#">サブページ</a>
    </li>
@endsection
@section('content')
<main class="subject-page">
    <section class="subject-info">
        <table class="overview-table">
            <tr><th>科目名</th><td>Java基礎</td></tr>
            <tr><th>授業概要</th><td>Javaの基礎構文を学習</td></tr>
            <tr><th>使用する技術・言語</th><td>Java</td></tr>
            <tr><th>リンク</th><td><a href="#">Java基礎科目サブページへ</a><br>
            <a href="#">まとめページへ</a></td></tr>
        </table>
    </section>

    <section class="comments">
        <h2 class="section-title">生徒からのコメント</h2>
        <div class="comment-box">
            <div class="comment-content">
                <img src="https://picsum.photos/400/400" alt="satoアイコン" class="avatar">
                <div class="name-date">
                    <p class="username">sato</p>
                    <p class="date">2025/1/13</p>
                    <button class="material-symbols-outlined delete-button">more_horiz</button>
                    <div class="delete-menu">
                        <button class="confirm-delete">コメントを削除</button>
                    </div>
                </div>
            </div>
            <p class="text">授業の内容が分かりやすい</p>
        </div>
        
        <div class="comment-box">
            <div class="comment-content">
                <img src="https://picsum.photos/400/400" alt="satoアイコン" class="avatar">
                <div class="name-date">
                    <p class="username">tanaka</p>
                    <p class="date">2025/1/1</p>
                    <button class="material-symbols-outlined delete-button">more_horiz</button>

                    <div class="delete-menu">
                        <button class="confirm-delete">コメントを削除</button>
                    </div>
                </div>
            </div>
            <p class="text">資料が見やすく復習がしやすかった</p>
        </div>
        @include('components.comment')
    </section>
</main>
@endsection

@section('js')
    <script src="js/comment.js"></script>
@endsection