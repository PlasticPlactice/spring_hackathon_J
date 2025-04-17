@extends('layouts.base')
@section('title','今季履修可能科目登録')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />

@endsection
@component('components.side_bar')
@endcomponent
@section('content')


    <h1>個別時間割の作成(履修登録)画面</h1>
    <form action="/personal_timetable_register" method="post">
        @csrf 
        
        @component('components.subject-side-menu')
        @slot('subject_list_content')
    @foreach ($courseLists as $key =>  $courseList)
            <li><label for="{{$key}}"><input id="{{$key}}" type="checkbox" name="items[]" class="course-lists" value="{{$courseList->id}}">{{$courseList->title}}</label></li>
            @endforeach
            @endslot
        @endcomponent
    <table id="personal-timetable-register" class="table subject-table">
            <tr class="subject-schedule">
                <td></td>
                @foreach($days as $day)
                    <th class="th-horizontal">{{ $day }}</th>
                @endforeach
            </tr>
            @for ($frames = 1; $frames < 5; $frames++)
                <tr class="subject-schedule">
                <th class="th-vertical">{{ $frames + 1 }}限</th>
                    @for ($day = 1; $day < 6; $day++)
                        <td id="{{$frames.'-'.$day}}"  class="subject-td">-</td>
                    @endfor
                </tr>
            @endfor
        </table>
        <input type="submit" value="送信" class="button" id="register-time-button">
    </form>

    
<script>
    const courseLists = @json($courseLists);
    
    // 各科目のチェックボックスを習得
    Array.from(document.getElementsByClassName('course-lists')).forEach(function(checkbox) {
        checkbox.addEventListener('change', function(event) {
            // チェックボックスの状態を取得
            if (this.checked) {
                // 画面に追加

                
                const id = this.id;
                const data = courseLists[id];
                console.log(data);
                
                
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
@section('js')
    <script src="/js/subject-side-menu.js"></script>
@endsection
