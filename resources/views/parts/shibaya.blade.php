@extends('layouts.base')
@section('content')
<div class="comment-box">
        <div class="comment">
            <div class="comment-content">
                <img src="https://picsum.photos/400/400" alt="satoアイコン" class="avatar">
                <div class="name-date">
                    <p class="username">sato</p>
                    <p class="date">2025/1/1</p>
                    <button class="comment-delete">・・・</button>
                    <div class="delete-menu">
                        <button class="confirm-delete">コメントを削除</button>
                    </div>
                </div>
            </div>
            <p class="text">授業の内容が分かりやすい</p>
        </div>
    </div>
@endsection
@section('js')
    <script src="/js/posted_comment.js"></script>
@endsection