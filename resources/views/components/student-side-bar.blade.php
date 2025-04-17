<li class="side-bar-item" id="content-1" tabindex="0">
    <a href="/student_top">生徒トップ</a>
</li>
<li class="side-bar-item" id="content-2" tabindex="0">
    <a href="/subjects_master_list">科目一覧</a></li>
@component('components.side_bar_menu')
    @slot('content_id')
        3
    @endslot
    @slot('side_bar_menu')
        個別時間割
    @endslot
    @slot('sub_menu')
        <li><a href="/personal_timetable_register">作成</a></li>
        <li><a href="/personal_timetable_edit">編集</a></li>
    @endslot
@endcomponent