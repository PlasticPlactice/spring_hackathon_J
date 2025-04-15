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
<div class="temp-content">
    <h1>今季履修可能科目編集・削除画面</h1>
    <form action='/available_subject_edit' method='post'>
        <table id="tr-edit-size" class="tr-space">
            @csrf
                <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>教科名：</th>
                <td><input type="text" name="title" value='{{$form->title}}' class="input-td"></td>
            </tr>
            <tr>
                <th>教師：</th>
                <!-- <td><input type="text" name="teacher_id" value='{{$form->teacher_id}}'></td> -->
                <td><select name="teacher-select" class="select"></td>
            </tr>
            <tr>
                <th>年度：</th>
                <!-- <td><input type="text" name="year" value='{{$form->year}}'></td> -->
                <td><select name="year-select" class="select"></td>
            </tr>

            <tr>
                <th>学期：</th>
                <td>
                    <label>
                        前期<input type="radio" name="session_flg" value="0" checked>
                    </label>    
                    <label>
                        後期<input type="radio" name="session_flg" value="1" id="session_flg"
                        {{ old('session_flg', $form->session_flg) == 1 ? 'checked' : '' }}></td>
                    </label>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="action" value="更新" id="button-space" class="button"></td>
                <td colspan="2"><input type="submit" name="action" value="削除" class="delete-button"></td>
            </tr>
        </table>
    </form>
</div>
@endsection