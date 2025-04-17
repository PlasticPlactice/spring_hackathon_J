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
                <td><input type="text" name="title" class="select"></td>
            </tr>
            <tr>
                <th>教師名</th>
                <td>
                    <select name="teacher_id" class="subject-register select">
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
                <td><select name="year" class="subject-register select">
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
                    </select></td>
            </tr>
            <tr>
                <th>前期/後期</th>
                <td>
                    <select name="session_flg" class="subject-register select">
                        <option value="0">前期</option>
                        <option value="1">後期</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>科目マスタ</th>
                <td>
                    <select name="subject_id" class="subject-register select">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{$subject->name}}
                        </option>
                    @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <div class="personal-button"  style="width:75%; text-align:right;">
            <input type="submit" value="送信" class="button" >
        </div>
    </form>
</div>
@endsection








<style>
    table{
        padding-left:0px!important;
        margin-left:100px!important;
    }
    th{
        padding-right:10px!important;
        font-weight: normal;
    }
    h1{
        text-align:left;
        padding-left:100px!important;
        margin-top:20px!important;
    }
</style>