@extends('layouts.base')
@section('title','教師一覧')
@section('external_css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@component('components.side_bar')
@endcomponent

@section('content')
<div id="page-container">
    <div>
        <h1 class="page-title-h1">教師一覧</h1>
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
            <button class="button">検索</button>
        </div>

        <table class="table students-list-table">
            <tr>
                <th class="th-horizontal">ID</th>
                <th class="th-horizontal">名前</th>
                <th class="th-horizontal"></th>
            </tr>

            @foreach ($teachers as $teacher)
            <tr>
                <td>{{$teacher->email}}</td>
                <td>{{$teacher->name}}</td>
                <td>
                    <a href="/teacher_edit/{{$teacher->id}}" class="text-gray">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <a href="/teacher_delete/{{$teacher->id}}" class="text-red">
                        <span class="material-symbols-outlined">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection