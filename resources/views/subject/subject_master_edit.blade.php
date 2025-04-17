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
    <div id="subject-master-register-container">
        <div>
            <h1 class="page-title-h1">科目マスター登録</h1>
            <form action='/subject_master_edit' method='post'>
                @csrf
                <input type="hidden" name="id" value="{{$form->id}}">
                <div id="content-div">
                    @component('components.input_with_label')
                        @slot('label')
                        <label style="width:130px; display:block;" >科目名:</label>
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
                </div>
                <div style="display:flex; justify-content: start;">
                    <label style="width:130px;" >科目詳細情報 :</label> 
                    <textarea style="width: 60%; height: 100px;border-radius: 10px;font-size: 16px;" name="detail" placeholder="" >{{$form->detail}}</textarea>
                </div>

                <div  style="display:flex; justify-content: start;">
                    <label style="width:130px;">使用言語・技術 : </label>
                    <textarea  style="width: 60%; height: 100px;border-radius: 10px;font-size: 16px;" name="tech" placeholder="疑似言語" >{{$form->tech}}</textarea>
                </div>

                <div class="button-group-right" style="width:75%; text-align:right;">
                    <input type="submit" name="submit" value="登録" class="button">
                </div>
            </form>
        </div>
    <div>
<style>
    #subject-master-register-container{
        padding-left:80px;
        padding-top:20px;
    }
    form{
        display: flex;
        flex-direction: column; 
        gap:20px;
    }
    #content-div div{
        display: flex;
        margin-top:20px
    }
    form label{
        text-align: right;
        margin-right: 10px;
    }
</style>
@endsection