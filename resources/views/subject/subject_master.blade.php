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
<div class="subject-page" style="margin-bottom:0px!important;">
    <!-- 概要欄 -->
    <section class="subject-info">
        <table class="overview-table">
            <tr><th>科目名</th><td>{{$item->name}}</td></tr>
            <tr><th>授業概要</th><td>{{$item->detail}}</td></tr>
            <tr><th>使用する技術・言語</th><td>{{$item->tech}}</td></tr>
            <tr><th>リンク</th><td><a href="/subject_sub/{{$latestSubSubjectId}}">{{$item->name}}サブページへ</a><br>
            <!-- <a href="#">まとめページへ</a></td></tr> -->
        </table>
    </section>

    <!-- コメント欄 -->
    <section class="comments" >
        <h2 class="section-title">生徒からのコメント</h2>
        <div style="border:1px solid black;padding:10px; padding-bottom:100px;    " class="comment-item">
            @foreach($comments as $comment)
            <div style="margin-bottom:10px;" class="comment-info">
                <div style="display: flex; align-items: center;">
                    <img src="{{ $comment->student->img_path !== '' ? '/' : ''  }}{{$comment->student->img_path}}" alt="アイコン" class="avatar">
                    <h2>
                        <span class="comment-info-username">{{ $comment->student->name }}</span>
                        <span class="comment-info-date">{{$comment->created_at}}</span>
                    </h2>
                </div>
                <!-- <button class="material-symbols-outlined comment-more">more_horiz</button> -->
                <!-- <div class="delete-menu">
                    <button class="confirm-delete">コメントを削除</button>
                </div> -->
            </div>
            
            <div style="width:70%;text-align:left;padding-left:35px;" class="comment-value">
                <!-- <h3 class="comment-title">{{$comment->title}}</h3> -->
                <p class="comment-text">{{$comment->detail}}</p>
            </div>
            @endforeach

            
            <!-- コメント登録フォーム -->
            
            @auth('student')
            <form style="position:fixed; left:435px;  padding-left:50px; bottom:0px;; width:50%; margin-bottom:10px;  background-color:#ffffff;" action="/subject_master" method="post">
                @csrf
                <input type="hidden" name="y_subject_id" value="{{$subject_id}}">

                <div style="position:relative;" class="">
                    <input style="width:90%;height:60px; font-size:12px; margin-0 auto; border:1px solid black; " type="text" name="text" id="" placeholder="コメントを入力">
                    <button style="position:absolute; right:40px; bottom:15px; background: none;border: none;padding: 0;margin: 0; " type="submit"><img src="/submit.png"  style="height:20px;"alt="" srcset=""></button>
                </div>
            </form>
            @endauth
            </div>
    </section>
</div>
@endsection

@section('js')
    <script src="js/comment.js"></script>
@endsection