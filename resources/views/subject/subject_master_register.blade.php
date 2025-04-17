@extends('layouts.base')
@section('title','科目マスター登録')

@component('components.side_bar')
@endcomponent

@section('content')
    <div id="subject-master-register-container">
        <div>
            <h1 class="page-title-h1">科目マスター登録</h1>
            <form action='/subject_master_register' method='post'>
                @csrf
                
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
                        @endslot
                    @endcomponent
                </div>
                <div style="display:flex; justify-content: start;">
                    <label style="width:130px;" >科目詳細情報 :</label> 
                    <textarea style="width: 60%; height: 100px;border-radius: 10px;font-size: 16px;" name="detail" placeholder=""></textarea>
                </div>

                <div  style="display:flex; justify-content: start;">
                    <label style="width:130px;">使用言語・技術 : </label>
                    <textarea  style="width: 60%; height: 100px;border-radius: 10px;font-size: 16px;" name="tech" placeholder="疑似言語"></textarea>
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