@extends('layouts.base')
@section('title','生徒一覧')
@section('external_css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@component('components.side_bar')
@endcomponent

@section('content')
<div id="page-container">
    <div>
        <h1 class="page-title-h1">生徒一覧</h1>
        <div class="search-section">
            @component('components.input_with_label')
                @slot('label')
                    ID : 
                @endslot
                @slot('input_type')
                    text
                @endslot
                @slot('input_name')
                    student_id
                @endslot
                @slot('input_placeholder')
                    検索したいIDを入力
                @endslot
                @slot('input_value')
                @endslot
            @endcomponent
            @component('components.input_with_label')
                @slot('label')
                    名前 : 
                @endslot
                @slot('input_type')
                    text
                @endslot
                @slot('input_name')
                    student_name
                @endslot
                @slot('input_placeholder')
                    検索したい名前を入力
                @endslot
                @slot('input_value')
                @endslot
            @endcomponent
            <select name="course" id="" class="select-with-label">
                <option value="" selected disabled>--- 学科 ---</option>
                <option value="1">高度情報工学科</option>
                <option value="2">総合システム工学科</option>
                <option value="3">情報システム科</option>
            </select>
            <select name="course" id="" class="select-with-label">
                <option value="" selected disabled>--- 入学年度 ---</option>
                <option value="2025">2025</option>
            </select>
            <button class="button">検索</button>
        </div>

        <table class="table students-list-table">
            <tr>
                <th class="th-horizontal">アイコン</th>
                <th class="th-horizontal">ID</th>
                <th class="th-horizontal">名前</th>
                <th class="th-horizontal">入学年度</th>
                <th class="th-horizontal">学部</th>
                <th class="th-horizontal"></th>
            </tr>

            @foreach ($students as $student)
            <tr>
                <td><img src="{{ $student->img_path !== '' ? '/' : ''  }}{{$student->img_path}}" alt="アイコン画像" style="width: 20px; height: 20px;"></td>
                <td>{{$student->email}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->entrance_year}}</td>
                <td>{{$student->Department->name}}</td>
                <td>
                    <a href="/student_edit/{{$student->id}}" class="text-gray">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <a href="/student_delete/{{$student->id}}" class="text-red">
                        <span class="material-symbols-outlined">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection