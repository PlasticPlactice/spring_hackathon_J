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
<!-- 
<div class="temp-content">
    個別時間割の作成(履修登録)画面
    <form action="/personal_timetable_register" method="post">
        @csrf
        <table>
            <tr class="personal-timetable">
                <th>科目</th>
                <td>
                    <select name="course_list_id" class="select-subject">
                        @foreach ($courseLists as $CourseList)
                            <option value="{{$courseList->id}}">
                                {{$courseList->title}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr><td><input type="submit" value="作成" class="button" id="personal-button"></td></tr>
        </table>
    </form>
</div> -->



    <h1>個別時間割の作成(履修登録)画面</h1>
    <form action="/personal_timetable_register" method="post">
        @csrf 
        <input type="submit" value="送信">
    @foreach ($courseLists as $courseList)
        <label><input type="checkbox" name="items[]" class="course-lists" value="{{$courseList->id}}">{{$courseList->title}}</label>
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
    
    // 各科目のチェックボックスを習得
    Array.from(document.getElementsByClassName('course-lists')).forEach(function(checkbox) {
        checkbox.addEventListener('change', function(event) {
            // チェックボックスの状態を取得
            if (this.checked) {
                // 画面に追加
                const id = this.value - 1;
                const data = courseLists[id];
                const title = data.title;
                data.time__tables.forEach(datum => {
                    const td = document.getElementById(`${datum.frames}-${datum.day_of_week}`);
                    
                    if(td.innerHTML === '-'){
                        td.innerHTML = ''
                    }
                    
                    // span要素を作成
                    const span = document.createElement('span');
                    // クラスを `${frames}-${day_of_week}` の形式で追加
                    span.id = `${id}-${datum.frames}-${datum.day_of_week}`;
                    // 中のテキストを設定
                    span.textContent = title;
                    // どこかの親要素に追加（例: id="target"）
                    td.appendChild(span)
                });

            } else {
                // 画面から削除
                const id = this.value - 1;
                const data = courseLists[id];
                data.time__tables.forEach(datum => {
                    const span = document.getElementById(`${id}-${datum.frames}-${datum.day_of_week}`);
                    span.remove();
                    const td = document.getElementById(`${datum.frames}-${datum.day_of_week}`);
                    if(td.innerHTML === ''){
                        td.innerHTML = '-'
                    }
                });
                
            }
        });
    });

</script>    
@endsection

