@extends('layouts.base')
@section('title','今季履修可能科目登録')
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
    <h1>今季履修可能科目登録画面</h1>
    <form action="/available_subject_register" method="post">
        @csrf
        <table id="tr-edit-size" class="tr-space">
            <tr>
                <th>科目名</th>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <th>教師名</th>
                <td>
                    <select name="teacher_id" class="subject-register">
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{$teacher->name}}
                        </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>年度</th>
                <td><input type="text" name="year"></td>
            </tr>
            <tr>
                <th>前期/後期</th>
                <td>
                    <select name="session_flg" class="subject-register">
                        <option value="0">前期</option>
                        <option value="1">後期</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>科目マスタ</th>
                <td>
                    <select name="subject_id" class="subject-register">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{$subject->name}}
                        </option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr class="personal-button">
                <td><input type="submit" value="送信" class="button"></td>
            </tr>
        </table>
    </form>
</div>
@endsection