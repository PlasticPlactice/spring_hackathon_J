@extends('layouts.base')
@section('title','生徒トップ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
@endsection

@component('components.side_bar')
@endcomponent
@section('content')
<div id="page-container">
    <div>
        <table class="table subject-table">
            <tr>
                <td></td>
                @foreach($days as $day)
                    <th class="th-horizontal">{{ $day }}</th>
                @endforeach
            </tr>

            @for ($frames = 0; $frames < 4; $frames++)
                <tr>
                    <th class="th-vertical">{{ $frames + 1 }}限</th>
                    @for ($day = 0; $day < 5; $day++)
                    <td class="subject-td">
                        @if(!empty($timeTables[$day + 1][$frames + 1]['title']))
                            <a href="http://127.0.0.1:8000/subject_sub/{{$timeTables[$day + 1][$frames + 1]['id']}}">{{ $timeTables[$day + 1][$frames + 1]['title'] }}</a><br>
                        @else
                            &mdash;
                        @endif
                    </td>
                    @endfor
                </tr>
            @endfor
        </table>

        <div class="favorite-page-section">
            <h2>お気に入りページ</h2>
            <table class="table favorite-page-table">
                <tr>
                    <th class="th-horizontal"></th>
                    <th class="th-horizontal">ページ名</th>
                    <th class="th-horizontal">カテゴリ</th>
                </tr>
                
                <!-- お気に入りの表示 -->
                @foreach($courseLists as $courseList)
                <tr>
                    <td class="favorite-td-star">
                        <a href="/student_del_favorite/{{$courseList->id}}">
                            <span class="material-symbols-outlined favorite-star-icon">star</span>
                        </a>
                    </td>
                    <td class="favorite-td-name">
                        @if($courseList->session_flg === 0)
                        <a href="subject_sub/{{$courseList->id}}">{{$courseList->title}} : {{$courseList->year}}前期</a>
                        @else
                        <a href="subject_sub/{{$courseList->id}}">{{$courseList->title}} : {{$courseList->year}}後期</a>
                        @endif
                    </td>
                    <td class="favorite-td-category">サブページカテゴリ</td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
</div>
@endsection
