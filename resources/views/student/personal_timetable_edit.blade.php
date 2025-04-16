@extends('layouts.base')
@section('title','時間割編集')
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
        @slot('sub_menu')
        @endslot

    @endcomponent
@endsection

@section('content')


    <h1>個別時間割の編集(履修編集)画面</h1>
    <form action="/personal_timetable_edit" method="post" id="add-form">
        @csrf 
        <input type="submit" value="送信">
    @foreach ($courseLists as $courseList)
        <label><input type="checkbox" name="items[]" class="course-lists" value="{{$courseList->id}}" @if(in_array($courseList->id,$studentCourseList->toArray())) checked @endif>{{$courseList->title}}</label>
    @endforeach
    <table class="table subject-table">
            <tr>
                <td></td>
                @foreach($days as $day)
                    <th class="th-horizontal">{{ $day }}</th>
                @endforeach
            </tr>
            @for ($frames = 1; $frames < 5; $frames++)
                <tr>
                <th class="th-vertical">{{ $frames + 1 }}限</th>
                    @for ($day = 1; $day < 6; $day++)
                        <td id="{{$frames.'-'.$day}}"  class="subject-td">-</td>
                    @endfor
                </tr>
            @endfor
        </table>
    </form>

    
<script>
    const courseLists = @json($courseLists);
    
     // 各科目のチェックボックスを取得
     Array.from(document.getElementsByClassName('course-lists')).forEach(function(checkbox) {
        // 初回の処理（ページロード時）
        if (checkbox.checked) {
            // チェックされている場合、処理を実行
            const id = checkbox.value - 1;
            const data = courseLists[id];
            const title = data.title;
            data.time__tables.forEach(datum => {
                const td = document.getElementById(`${datum.frames}-${datum.day_of_week}`);
                
                if (td.innerHTML === '-') {
                    td.innerHTML = '';
                }
                
                // span要素を作成
                const span = document.createElement('span');
                // クラスを `${frames}-${day_of_week}` の形式で追加
                span.id = `${id}-${datum.frames}-${datum.day_of_week}`;
                // 中のテキストを設定
                span.textContent = title;
                // どこかの親要素に追加（例: id="target"）
                td.appendChild(span);
            });
        }

        // チェックボックスの状態が変更された時に実行
        checkbox.addEventListener('change', function(event) {
            // チェックボックスの状態を取得
            if (this.checked) {
                // 画面に追加
                const id = this.value - 1;
                const data = courseLists[id];
                const title = data.title;
                data.time__tables.forEach(datum => {
                    const td = document.getElementById(`${datum.frames}-${datum.day_of_week}`);
                    
                    if (td.innerHTML === '-') {
                        td.innerHTML = '';
                    }
                    
                    // span要素を作成
                    const span = document.createElement('span');
                    // クラスを `${frames}-${day_of_week}` の形式で追加
                    span.id = `${id}-${datum.frames}-${datum.day_of_week}`;
                    // 中のテキストを設定
                    span.textContent = title;
                    // どこかの親要素に追加（例: id="target"）
                    td.appendChild(span);
                });
            } else {
                // 画面から削除
                const id = this.value - 1;
                const data = courseLists[id];
                data.time__tables.forEach(datum => {
                    const span = document.getElementById(`${id}-${datum.frames}-${datum.day_of_week}`);
                    span.remove();
                    const td = document.getElementById(`${datum.frames}-${datum.day_of_week}`);
                    if (td.innerHTML === '') {
                        td.innerHTML = '-';
                    }
                });
            }
        });
    });

const studentCourseList = @json($studentCourseList);

// 最初のデータを送信する処理
document.getElementById('add-form').addEventListener('submit', function(event) {

// 送信データにデータを追加
const hiddenInput = document.createElement('input');
hiddenInput.type = 'hidden';
hiddenInput.name = 'studentCourseList'; // サーバー側ではこの名前で受け取る
hiddenInput.value = JSON.stringify(studentCourseList);

this.appendChild(hiddenInput);
});

    </script>    
@endsection
