@extends('layouts.base')
@section('title','生徒データ登録')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
@endsection
@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection
@section('content')
<div class="temp-content">
    <h2 class="register-content-p">生徒データ登録</h2>
    <p class="register-content-p">生徒名簿のCSVファイルを選択してください(対応文字コード : UTF-8)</p>
    <p class="register-content-p">形式：メールアドレス,名前,入学年度,学科</p>
    <p class="register-content-p">例：t.jyobi.sys25@morijyobi.ac.jp,ジョビ太郎,2022,総合システム工学科</p>
    <form action="students_add" method="post" enctype="multipart/form-data">
        @csrf
    <div id="file-select-students">
        <input type="file" name="csv_file" accept=".csv">
    </div>
    <div>
        <input type="submit" value="送信" class="button">
    </div>
    </form>
    <!-- エラー表示 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection