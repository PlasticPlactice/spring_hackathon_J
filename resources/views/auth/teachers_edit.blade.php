@extends('layouts.base')
@section('title','今季履修可能科目登録')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />

@endsection
@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection
@section('content')
<div class="temp-content">
    <h2 class="edit-content">教師データ編集・削除</h2>
    <form action="/teacher_update/{{$teacher->id}}" method="post" class="edit-content">
        @csrf
        id: <sapn>{{$teacher->email}}</sapn><br>
        パスワードリセット:<input type="checkbox" name="password_reset" value="1"><br>
        名前 <input type="text" name="name" value="{{$teacher->name}}"><br>

        <input type="submit" value="更新" class="button" id="edit-button-content">
    </form>

      <!-- バリデーションエラーの一覧表示 -->
      @if ($errors->any())
        <div>
            <h4>入力エラーがあります:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection