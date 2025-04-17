@extends('layouts.base')
@section('title','科目マスター編集・削除')

@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="#">ページ名</a>
    </li>
    <li class="side-bar-item" id="content-3" tabindex="0">
        <a href="#">ページ名</a>
    </li>
    <li class="side-bar-item" id="content-4" tabindex="0">
        <a href="#">ページ名</a>
    </li>
    <li class="side-bar-item" id="content-5" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection

@section('content')
    <div id="subject-master-edit-container">
        <div>
            <h1 class="page-title-h1">科目マスター編集・削除</h1>
            <form action='/subject_master_edit' method='post'>
            @csrf
                <input type="hidden" name="id" value="{{$form->id}}">

                @component('components.input_with_label')
                    @slot('label')
                        科目名 : 
                    @endslot
                    @slot('input_type')
                        text
                    @endslot
                    @slot('input_name')
                        name
                    @endslot
                    @slot('input_placeholder')
                        アルゴリズム
                    @endslot
                    @slot('input_value')
                        {{$form->name}}
                    @endslot
                @endcomponent

                <div>
                    科目詳細情報 : 
                    <textarea name="detail" placeholder="IT業界への入門の位置づけである国家資格「基本情報技術者試験」「ITパスポート」の合格を目指し、アルゴリズム分野の基礎知識を習得する。" value="{{$form->detail}}">
                </div>

                <div>
                    使用言語・技術 : 
                    <textarea name="tech" placeholder="疑似言語" value="{{$form->tech}}">
                </div>

                <div class="button-group-right">
                    <input type="submit" name="submit" value="登録" class="button">
                    <input type="submit" name="delete" value="削除" class="button">
                </div>
            </form>
        </div>
    <div>
@endsection