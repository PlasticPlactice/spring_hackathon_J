@extends('layouts.base')
@section('title','科目サブページ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_horiz" />
    <link rel="stylesheet" href="{{asset('css/shibaya_style.css')}}">
@endsection

@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">科目ページ一覧</a>
    </li>
    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="#">科目ページ</a>
    </li>
    <li class="side-bar-item" id="content-3" tabindex="0">
        <a href="#">サブページ</a>
    </li>
@endsection

@section('content')
    <div id="subject-sub-container">
        <div>
            <div id="sub-page-header">
                <h1 class="page-title-h1">{{$subjectName}}<span class="page-subtitle">({{$teacherName}})</span></h1>
                <div>
                    <p>概要</p>
                    <a href="subject_sub_result_info">授業記録</a>
                </div>
            </div>
        </div>
        <div class="page-info">
            <p>概要</p>
            <table class="overview-table">
                <tr><th>科目名</th><td>Java基礎</td></tr>
                <tr><th>担当</th><td>山田太郎</td></tr>
            </table>
        </div>
    </div>
</body>
<script src="/js/subject_sub.js"></script>
</html>