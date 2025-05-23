@extends('layouts.base')
@section('title','科目一覧')

@component('components.side_bar')
@endcomponent
@section('content')
<div id="page-container">
    <div>
        <h1 class="page-title-h1">科目一覧</h1>
            <form style="position:relative;" action="/subjects_master_list_search" method="get" class="search-section">
                @component('components.input_with_label')
                    @slot('label')
                        科目検索 :
                    @endslot
                    @slot('input_type')
                        text
                    @endslot
                    @slot('input_name')
                        text
                    @endslot
                    @slot('input_placeholder')
                        科目名を入力　例:Python
                    @endslot
                    @slot('input_value')
                    @endslot
                @endcomponent
                <button style="position:absolute; top:0px; right:200px;" type="submit" class="button">検索</button>
            </form>
        

        <table class="table subject-master-table">
            <tr>
                <th class="th-horizontal width-4pct">ID</th>
                <th class="th-horizontal width-32pct">科目名</th>
                <th class="th-horizontal width-32pct">概要</th>
                <th class="th-horizontal width-32pct">使用言語</th>
            </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>
                    <a href="/subject_master/{{ $item->id }}">{{$item->name}}</a>
                </td>
                <td>{{$item->detail}}</td>
                <td>{{$item->tech}}</td>
            </tr>
        @endforeach
        </table>
    </div>
</div>
@endsection