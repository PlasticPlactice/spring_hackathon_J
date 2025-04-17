@extends('layouts.base')
@section('title','今季履修可能科目編集・削除')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
@endsection
@component('components.side_bar')
@endcomponent
@section('content')
<div class="temp-content">
    <h1 id="title">今季履修可能科目編集・削除画面</h1>
    <form action='/available_subject_edit' method='post'>
        @csrf
    <input type="hidden" name="id" value="{{$form->id}}">

    <table id="tr-edit-size" class="tr-space">
            <tr>
                <th>科目名</th>
                <td><input type="text" name="title" class="select" value="{{$form->title}}" ></td>
            </tr>
            <tr>
                <th>教師名</th>
                <td>
                    <select name="teacher_id" class="subject-register select">
                        @foreach ($teachers as $teacher)
                        <option {{ $form->teacher_id == $teacher->id ? 'selected' : '' }} value="{{ $teacher->id }}">
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
                <option selected value="2025">2025</option>
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
                        <option  {{ $form->session_flg == "0" ? 'selected' : '' }} value="0">前期</option>
                        <option  {{ $form->session_flg == "1" ? 'selected' : '' }}  value="1">後期</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>科目マスタ</th>
                <td>
                    <select name="subject_id" class="subject-register select">
                    @foreach ($subjects as $subject)
                        <option {{ $selectSubject->subject_id === $subject->id ? 'selected' : '' }}  value="{{ $subject->id }}">
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

<style>
    table{
        padding-left:0px!important;
        margin-left:100px!important;
    }
    th{
        padding-right:10px!important;
        font-weight: normal;
    }
    #title{
        text-align:left;
        padding-left:100px!important;
        margin-top:20px!important;
    }
</style>
@endsection

