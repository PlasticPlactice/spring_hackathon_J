@extends('layouts.base')
@section('title','今季履修可能科目登録')
@section('external_css')
<link rel="stylesheet" href="/css/kowada-style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />

@endsection
@component('components.side_bar')
@endcomponent
@section('content')
<div id="page-container">
    <div>
        <h1>時間割作成画面</h1>

        <div id="timetable-register-filter">
            <div>
                <!-- 科目サイドメニュー(右側) -->
                @component('components.subject-side-menu')
                    @slot('subject_list_content')
                        <li>Python基礎</li>
                        <li>Python応用<br>(tkinter)</li>
                        <li>html,css<br>基礎</li>
                        <li>JavaScript<br>基礎</li>
                        <li>Java基礎</li>
                        <li>C#基礎基礎</li>
                    @endslot
                @endcomponent

                <!-- 検索フォーム -->
                <form action="timetable_register" method="get">
                    <select name="year" class="timetable-select select">
                        @foreach($years as $year)
                            <option value="{{$year}}" @if(isset($jsonData) && $jsonData['year'] === $year) selected @endif >{{$year}}</option>
                        @endforeach
                    </select>
                    <select name="session_flg" class="timetable-select select">
                        <option value="0" @if(isset($jsonData) && $jsonData['session_flg'] === 0) selected @endif>前期</option>
                        <option value="1" @if(isset($jsonData) && $jsonData['session_flg'] === 1) selected @endif>後期</option>
                    </select>
                    <input type="submit" value="検索" class="button">
                </form>

                @if(isset($courseList))
                <!-- 科目一覧 -->
                <select id="select-subject" name="" class="timetable-select select">
                @foreach($courseList as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
                </select>
                @endif

                <!-- 時間割に追加ボタン -->
                <button type="button" id="add-button" class="button">②追加</button>
            </div>

            <!-- 登録フォーム -->
            <form action="timetable_add" method="post" id="add-form">
                @csrf
                <input type="submit" value="③登録" id="register-button" class="button">
            </form>
        </div>


        <!-- 時間割の表示処理(バックエンド) -->
        <table id="table" class="table">
            <tr>
                <td></td>
                <th style="min-width:100px;" class="th-horizontal">月</th>
                <th style="min-width:100px;" class="th-horizontal">火</th>
                <th style="min-width:100px;" class="th-horizontal">水</th>
                <th style="min-width:100px;" class="th-horizontal">木</th>
                <th style="min-width:100px;" class="th-horizontal">金</th>
            </tr>
            @if(isset($jsonData))
                <!-- jsonがある場合の処理 -->
                @for($i = 1; $i < 5; $i++)
                <tr>
                    <th class="th-vertical">{{$i}}</th>
                    @for($j = 1; $j < 6; $j++)
                    <td id="{{$i}}-{{$j}}" class="subject-td">
                        <label style="display:block; height:100px" for="register-subject{{$i}}-{{$j}}">
                            <input type="checkbox" class="add-check" value="{{$i}}-{{$j}}" name="" id="register-subject{{$i}}-{{$j}}">
                            
                            @foreach($jsonData['table'][$i][$j] as $item)
                            <button type="button" value="{{$i}}-{{$j}}-{{$item['id']}}" class="subject-items">
                                <span>{{$item['title']}}</span>
                            </button>
                            @endforeach
                        </label>
                    </td>
                    @endfor    
                </tr>
                @endfor
            @else
                <!-- jsonがない場合の処理 -->
                @for($i = 1; $i < 5; $i++)
                    <tr>
                        <th class="th-vertical">{{$i}}</th>
                        <td class="subject-td">jsonがありません</td>
                        <td class="subject-td">jsonがありません</td>
                        <td class="subject-td">jsonがありません</td>
                        <td class="subject-td">jsonがありません</td>
                        <td class="subject-td">jsonがありません</td>
                    </tr>
                @endfor
            @endif
        </table>

    </div>

<script>// PHPの変数をJSON文字列にしてJavaScriptで使える形にする
@if(isset($jsonData))
const jsonData = @json($jsonData);
const courseList = @json($courseList);

// tableに表示されているデータを取得(一件一件)
let subjectItems = document.getElementsByClassName('subject-items');

// 追加ボタン
const addButton = document.getElementById('add-button');
// チェックボックスを取得
const checkBoxs = document.getElementsByClassName('add-check');
// 科目を選択するセレクトボックス
const selectSubject = document.getElementById("select-subject");

// 送信する時間割情報を格納する連想配列を格納した配列
const sendData =  {
    year: jsonData['year'],
    session_flg: jsonData['session_flg'],
};
const addData = {
    table:[]
}
const delData = {
    table:[]
}

for (let i = 1; i <= 4; i++) {
    addData[i] = {}; // 各行に対して空オブジェクトを用意
    delData[i] = {}; // 各行に対して空オブジェクトを用意
    for (let j = 1; j <= 5; j++) {
        addData[i][j] = []; // その中に空配列を用意
        delData[i][j] = []; // その中に空配列を用意
    }
}



// 削除処理
function attachSubjectItemClickEvents() {
    subjectItems = document.getElementsByClassName('subject-items');
    Array.from(subjectItems).forEach(function(subjectItem) {
        subjectItem.addEventListener('click', function() {

            const parts = this.value.split('-');
            const frames = parts[0]; // コマ
            const dayOfWeek = parts[1]; // 曜日(1=5) 
            const id = parts[2]; // 科目ID
            // console.log(`${frames}-${dayOfWeek}`);

            const td = document.getElementById(`${frames}-${dayOfWeek}`);
            setTimeout(() => {
            console.log("0.5秒後に実行されました");
            td.style.backgroundColor = '';
            }, 10); // 500ミリ秒 = 0.5秒
            
            

            // 同じSubjectIdがすでにあるかどうかをチェック
            const isDuplicate = jsonData['table'][frames][dayOfWeek].some(item => {
                return item['id'] === Number(id);
            });
            // addにあるかを確認
            const isDuplicateAdd = addData[frames][dayOfWeek].some(item => {
                return item === Number(id);
            });
            // 削除配列に追加されているかを取得
            const isDuplicatedel = addData[frames][dayOfWeek].some(item => {
                return item === Number(id);
            });

            
            if((!isDuplicate || isDuplicatedel) && (isDuplicate && isDuplicateAdd)){
                this.remove(); // クリックされた要素を削除
                return;
            }
            if(isDuplicateAdd){
                // add配列からデータを削除
                const index = addData[frames][dayOfWeek].indexOf(Number(id)); 

                if (index !== -1) {
                    addData[frames][dayOfWeek].splice(index, 1); 

                }
            }else{
                // 削除配列に追加
                if(!delData[frames][dayOfWeek].includes(Number(id)))
                delData[frames][dayOfWeek].push(Number(id)); 
            }

            this.remove(); // クリックされた要素を削除
        });
    });
}

// 初期登録（ページ読み込み時）
attachSubjectItemClickEvents();

// 画面上の時間割に科目を追加する処理
addButton.addEventListener('click', function() {
    
    // 現在選択されている科目のidを取得
    const SubjectId = selectSubject.value;
    // チェックが選択されていた場合の処理
    Array.from(checkBoxs).forEach(checkbox => {
        
        if (checkbox.checked) {
            const td = checkbox.closest('td');

            
            // valueをそれぞれ必要な情報に分割
            const parts = checkbox.value.split("-"); 
            
            const frames = parts[0]; // コマ
            const dayOfWeek = parts[1]; // 曜日(1=5)

            // 同じSubjectIdがすでにあるかどうかをチェック
            const isDuplicate = jsonData['table'][frames][dayOfWeek].some(item => {
                return Number(item['id']) === Number(SubjectId);
            });
            
            // addにあるかを確認
            const isDuplicateAdd = addData[frames][dayOfWeek].some(item => {
                return Number(item) === Number(SubjectId);
            });
            
            // 削除配列に追加されているかを取得
            const isDuplicatedel = delData[frames][dayOfWeek].some(item => {
                return item === Number(SubjectId);
            });
            if (isDuplicateAdd || (isDuplicate && !isDuplicatedel && !isDuplicateAdd)  ) {
                checkbox.checked = false;  
                td.style.backgroundColor = 'var(--white)';  
                return; // 重複してるのでスキップ
            }


            if(!isDuplicatedel){
                // 送信用配列にデータを追加         
                addData[frames][dayOfWeek].push(Number(SubjectId)); 
            }else{
                // 削除配列から削除
                const index = delData[frames][dayOfWeek].indexOf(Number(SubjectId)); 
                if (index !== -1) {
                    delData[frames][dayOfWeek].splice(index, 1); 
                    
                }

                
            }
            
            
            createTd(frames,dayOfWeek,SubjectId);


            // チェックを外す
            checkbox.checked = false;
            td.style.backgroundColor = 'var(--white)';  

        }
    });

    // subject-items を再取得してイベント再登録
    attachSubjectItemClickEvents();
    
});

function createTd(frames,dayOfWeek,SubjectId){
    // 画面の時間割に表示
    const td = document.getElementById(`${frames}-${dayOfWeek}`);
    const label = td.querySelector('label');
                
    // タグの中に要素を追加
    // button要素作成
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'subject-items';
    button.value = `${frames}-${dayOfWeek}-${SubjectId}`;

    // span要素作成
    const span = document.createElement('span');
    // 選択されている科目を取得
    const selectedText = selectSubject.options[selectSubject.selectedIndex].text;            
    span.textContent = selectedText;

    button.appendChild(span);
    label.appendChild(button); // tdの末尾に追加

}

// 登録データを送信する処理
document.getElementById('add-form').addEventListener('submit', function(event) {

    // 送信データにデータを追加
    sendData['addData'] = addData;
    sendData['delData'] = delData;

    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'sendData'; // サーバー側ではこの名前で受け取る
    hiddenInput.value = JSON.stringify(sendData);

    this.appendChild(hiddenInput);
});


@endif
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.add-check');
    console.log(this.value);
    
    
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const td = checkbox.closest('td');

            if (checkbox.checked) {
                td.style.backgroundColor = 'var(--gray)';
            } 
            else {
                td.style.backgroundColor = '';
            }
        });
    });
});

</script>
</div>
@endsection
@section('js')
    <script src="/js/subject-side-menu.js"></script>
@endsection