@extends('layouts.base')
@section('title','教師トップ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
@endsection

@section('side_bar_content')
    <li class="side-bar-item" id="content-1" tabindex="0">
        <a href="#">生徒登録</a>
    </li>
    <li class="side-bar-item" id="content-2" tabindex="0">
        <a href="#">生徒一覧</a>
    </li>
    <li class="side-bar-item" id="content-3" tabindex="0">
        <a href="#">科目一覧</a>
    </li>
@endsection

@section('content')
<div id="teacher-top-container">
    <div>
        <h1>〇〇先生、お疲れ様です。</h1>
        <div class="favorite-page-section">
            <h2>お気に入りページ</h2>
            <table class="table favorite-table">
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