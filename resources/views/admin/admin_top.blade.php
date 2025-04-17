@extends('layouts.base')
@section('title','管理者トップ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
@endsection

@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">履修科目登録</a>
    </li>
    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="#">時間割登録</a>
    </li>
    <li class="side-bar-item" id="content-3" tabindex="0">
        <a href="#">教師一覧</a>
    </li>
    <li class="side-bar-item" id="content-4" tabindex="0">
        <a href="#">生徒一覧</a>
    </li>
    <li class="side-bar-item" id="content-5" tabindex="0">
        <a href="#">科目一覧</a>
    </li>
@endsection

@section('content')
<div id="page-container">
    <div>

        <h1>お疲れ様です。</h1>
       <!-- adminはなにも表示しない -->

    </div>
</div>
@endsection