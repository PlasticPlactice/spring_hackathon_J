@extends('layouts.base')
@section('title','科目マスターページ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_horiz" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=send" />
    <link rel="stylesheet" href="{{asset('css/shibaya_style.css')}}">
@endsection
    
@component('components.side_bar')
@endcomponent
@section('content')
<div class="subject-page">
    <!-- 概要欄 -->
    <section class="subject-info">
        <table class="overview-table">
            <tr><th>科目名</th><td>Java基礎</td></tr>
            <tr><th>授業概要</th><td>Javaの基礎構文を学習</td></tr>
            <tr><th>使用する技術・言語</th><td>Java</td></tr>
            <tr><th>リンク</th><td><a href="#">Java基礎科目サブページへ</a><br>
            <a href="#">まとめページへ</a></td></tr>
        </table>
    </section>

    <!-- コメント欄 -->
    <section class="comments">
        <h2 class="section-title">生徒からのコメント</h2>
        <div class="comment-item">
                <div class="comment-info">
                    <div>
                        <img src="https://picsum.photos/400/400" alt="アイコン" class="avatar">
                        <h2>
                            <span class="comment-info-username">sato</span>
                            <span class="comment-info-date">2025/1/13 12:00</span>
                        </h2>
                    </div>
                    <button class="material-symbols-outlined comment-more">more_horiz</button>
                    <div class="delete-menu">
                        <button class="confirm-delete">コメントを削除</button>
                    </div>
                </div>

                <div class="comment-value">
                    <h3 class="comment-title">ダミーコメント</h3>
                    <p class="comment-text">授業の内容が分かりやすい</p>
                </div>
            </div>
    </section>
</div>
@endsection

@section('js')
    <script src="js/comment.js"></script>
@endsection