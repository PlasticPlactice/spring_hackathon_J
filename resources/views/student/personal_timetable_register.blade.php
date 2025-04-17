@extends('layouts.base')
@section('title','今季履修可能科目登録')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />

@endsection
@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">ページ名</a>
    </li>
@endsection
@section('content')
<div class="temp-content">
    個別時間割の作成(履修登録)画面
    <form action="/personal_timetable_register" method="post">
        @csrf
        <table>
            <tr class="personal-timetable">
                <th>科目</th>
                <td>
                    <select name="course_list_id" class="select-subject">
                        @foreach ($CourseLists as $CourseList)
                            <option value="{{$CourseList->id}}">
                                {{$CourseList->title}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr><td><input type="submit" value="作成" class="button" id="personal-button"></td></tr>
        </table>
    </form>
</div>
@endsection