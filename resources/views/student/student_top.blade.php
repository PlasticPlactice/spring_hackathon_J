@extends('layouts.base')
@section('title','生徒トップ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
@endsection

@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">科目一覧</a>
    </li>
    @component('components.side_bar_menu')
        @slot('content_id')
            2
        @endslot
        @slot('side_bar_menu')
            時間割
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
<div id="student-top-container">
    <div>
        <table class="table subject-table">
            <tr>
                <td>　</td>
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
                                {{ $timeTables[$day + 1][$frames + 1]['title'] }}<br>
                            @else
                                -
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
                
                <tr>
                    <td class="favorite-td-star">
                        <a href="#">
                            <span class="material-symbols-outlined favorite-star-icon">star</span>
                        </a>
                    </td>
                    <td class="favorite-td-name">
                        <a href="#">サブページ名</a>
                    </td>
                    <td class="favorite-td-category">サブページカテゴリ</td>
                </tr>
                
                <tr>
                    <td class="favorite-td-star">
                        <a href="#">
                            <span class="material-symbols-outlined favorite-star-icon">star</span>
                        </a>
                    </td>
                    <td class="favorite-td-name">
                        <a href="#">サブページ名</a>
                    </td>
                    <td class="favorite-td-category">サブページカテゴリ</td>
                </tr>
                <tr>
                    <td class="favorite-td-star">
                        <a href="#">
                            <span class="material-symbols-outlined favorite-star-icon">star</span>
                        </a>
                    </td>
                    <td class="favorite-td-name">
                        <a href="#">サブページ名</a>
                    </td>
                    <td class="favorite-td-category">サブページカテゴリ</td>
                </tr>
            </table>
        </div>

    </div>
</div>
@endsection