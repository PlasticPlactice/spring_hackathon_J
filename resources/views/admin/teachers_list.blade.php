@extends('layouts.base')
@section('title','教師一覧')
@section('external_css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@section('side_bar_content')
    @component('components.side_bar_menu')
        @slot('content_id')
            1
        @endslot
        @slot('side_bar_menu')
            マスタ科目
        @endslot
        @slot('sub_menu')
            <li><a href="https://www.google.co.jp/">登録</a></li>
            <li><a href="https://www.yahoo.co.jp/">編集・削除</a></li>
        @endslot
    @endcomponent
    @component('components.side_bar_menu')
        @slot('content_id')
            2
        @endslot
        @slot('side_bar_menu')
            今季履修可能科目
        @endslot
        @slot('sub_menu')
            <li><a href="https://www.google.co.jp/">登録</a></li>
            <li><a href="https://www.yahoo.co.jp/">編集・削除</a></li>
        @endslot
    @endcomponent
    <li class="side-bar-item" id="content-3" tabindex="0">
        <a href="#">時間割管理</a>
    </li>
    @component('components.side_bar_menu')
        @slot('content_id')
            4
        @endslot
        @slot('side_bar_menu')
            教師データ
        @endslot
        @slot('sub_menu')
            <li><a href="https://www.google.co.jp/">登録</a></li>
            <li><a href="https://www.yahoo.co.jp/">一覧</a></li>
        @endslot
    @endcomponent
    @component('components.side_bar_menu')
        @slot('content_id')
            5
        @endslot
        @slot('side_bar_menu')
            生徒データ
        @endslot
        @slot('sub_menu')
            <li><a href="https://www.google.co.jp/">登録</a></li>
            <li><a href="https://www.yahoo.co.jp/">一覧</a></li>
        @endslot
    @endcomponent
@endsection

@section('content')
<div id="students-list-container">
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
                    <a href="#" class="text-gray">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <a href="#" class="text-red">
                        <span class="material-symbols-outlined">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection


    </table>
</body>
</html>