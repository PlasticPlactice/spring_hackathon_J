<li class="side-bar-item" id="content-1" tabindex="0">
    <a href="/teacher_top">教師トップ</a>
</li>
<li class="side-bar-item" id="content-2" tabindex="0">
    <a href="/subjects_master_list">科目一覧</a>
</li>
@component('components.side_bar_menu')
    @slot('content_id')
        3
    @endslot
    @slot('side_bar_menu')
        生徒データ
    @endslot
    @slot('sub_menu')
        <li><a href="/students_list">一覧</a></li>
        <li><a href="/students_register?from_page=teacher">登録</a></li>
    @endslot
@endcomponent