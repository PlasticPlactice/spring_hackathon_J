@extends('layouts.base')

@section('title','test')

@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
@endsection

@section('side_bar_content')
    @component('components.side_bar_menu')
        @slot('content_id')
            1
        @endslot
        @slot('side_bar_menu')
            サブメニューあり
        @endslot
        @slot('sub_menu')
            <li><a href="https://www.google.co.jp/">登録</a></li>
            <li><a href="https://www.yahoo.co.jp/">編集・削除</a></li>
        @endslot
    @endcomponent
    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="https://www.yahoo.co.jp/">サブメニュー無し<br>直接リンク</a>
    </li>
    @component('components.side_bar_menu')
        @slot('content_id')
            3
        @endslot
        @slot('side_bar_menu')
            サブメニューあり(2)
        @endslot
        @slot('register_link')
            https://www.google.co.jp/
        @endslot
        @slot('edit_link')
            https://www.yahoo.co.jp/
        @endslot
    @endcomponent
@endsection
@section('content')
    <!-- @component('components.input_with_label')
        @slot('label','id:')
        @slot('input_type','text')
        @slot('input_name','id')
        @slot('input_placeholder','入力してください')
    @endcomponent
    @component('components.input_with_label')
        @slot('label','id:')
        @slot('input_type','text')
        @slot('input_name','id')
        @slot('input_placeholder','入力してください')
    @endcomponent
    @component('components.checkbox-with-label')
        @slot('label','check:')
        @slot('checkbox_name','text')
        @slot('message','massage')
    @endcomponent -->
    @component('components.subject-side-menu')
        @slot('subject_list_content')
            <li>Python基礎</li>
            <li>Python応用<br>(tkinter)</li>
            <li>html,css<br>基礎</li>
            <li>JavaScript<br>基礎</li>
            <li>Java基礎</li>
            <li>C#基礎基礎</li>
        @endslot
    @endcomponent
@endsection

@section('js')
    <script src="/js/subject-side-menu.js"></script>
@endsection