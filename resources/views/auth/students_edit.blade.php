@extends('layouts.base')
@section('title','今季履修可能科目編集・削除')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
@endsection
@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection
@section('content')
    <h2>生徒データ編集・削除</h2>
    <form action="/student_update/{{$student->id}}" method="post" enctype="multipart/form-data">
        @csrf

        <span>id</span><span>{{$student->email}}</span>
        パスワードリセット:<input type="checkbox" name="password_reset" value="1">
        名前 <input type="text" name="name" value="{{$student->name}}">
        画像 <input type="file" name="img_data">
        <img src="{{ asset($student->img_path) !== url('/').'/' ? asset($student->img_path) : '' }}" alt="アイコン画像">
        <br>
        学科:
        <select name="department" id="">
         @foreach($department as $item)                       
            <option value="{{ $item->id }}"  @if($item->id === $student->department->id)  selected  @endif>{{ $item->name }}</option>
        @endforeach
        </select>
        入学年度:
        
        <select name="entrance_year" id="">
        @foreach($years as $year)
            <option value="{{$year}}" @if($year === $student->entrance_year)  selected  @endif >{{$year}}</option>
        @endforeach
        </select>
        <input type="submit" value="更新">
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
@endsection