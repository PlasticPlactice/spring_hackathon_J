<li class="side-bar-item" id="content-1" tabindex="0">
    <a href="/admin_top">管理者トップ</a>
</li>
@component('components.side_bar_menu')
    @slot('content_id')
        2
    @endslot
    @slot('side_bar_menu')
        科目マスター
    @endslot
    @slot('sub_menu')
        <li><a href="subjects_master_list">一覧</a></li>
        <li><a href="subject_master_register">登録</a></li>
    @endslot
@endcomponent
@component('components.side_bar_menu')
    @slot('content_id')
        3
    @endslot
    @slot('side_bar_menu')
        生徒データ
    @endslot
    @slot('sub_menu')
        <li><a href="students_list">一覧</a></li>
        <li><a href="/students_register?from_page=admin">登録</a></li>
    @endslot
@endcomponent
@component('components.side_bar_menu')
    @slot('content_id')
        4
    @endslot
    @slot('side_bar_menu')
        教師データ
    @endslot
    @slot('sub_menu')
        <li><a href="teachers_list">一覧</a></li>
        <li><a href="teachers_register">登録</a></li>
    @endslot
@endcomponent
<li class="side-bar-item" id="content-5" tabindex="0">
    <a href="timetable_register">管理者時間割</a>
</li>
<li class="side-bar-item" id="content-6" tabindex="0">
    <a href="/available_subject_register">今季履修可能科目</a>
</li>