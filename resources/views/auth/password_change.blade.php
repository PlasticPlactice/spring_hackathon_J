<<<<<<< HEAD
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
{{ dd(session()->get('key')) }}

=======
@extends('layouts.base')
@section('title','パスワード変更')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
@endsection
@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection
@section('content')
<div id="pw-change-content">
>>>>>>> main
      <!-- バリデーションエラーの一覧表示 -->
      @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 id="pw-change-h1">パスワード変更</h1>
    <form action="{{$url}}" method="post">
        @csrf
    <div class="pw-change-form">
        <label>現在のパスワード</label>
        <input type="password" name="current_password">
    </div>

    <div class="pw-change-form">
        <label>新しいパスワード</label>
        <input type="password" name="new_password">
    </div>

    <div class="pw-change-form">
        <label>パスワード確認</label>
        <input type="password" name="new_password_confirmation">
    </div>
    <div id="pw-change-button">
        <input type="submit" value="送信" class="button">
    </div>
    </form>
</div>
@endsection