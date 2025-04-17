@extends('layouts.base')
@section('title','科目サブページ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_horiz" />
    <link rel="stylesheet" href="{{asset('css/shibaya_style.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=star" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@endsection

@component('components.side_bar')
@endcomponent

@section('content')
    <div style="height:100vh;  position: relative;" id="subject-sub-container">
        <span style="position: absolute;top: 20px;right:0px; border:none;" class="favorite-td-star">
        @auth('student')
            @if($FavoriteId)
            <a href="/student_del_favorite/{{$y_subject_id}}">
                <span class="material-symbols-outlined favorite-star-icon">star</span>
            </a>
            @else
            <a href="/student_add_favorite/{{$y_subject_id}}">
                <!-- 通常の星 -->
            <span class="material-icons">star_border</span>
            </a>

            @endif
        @endauth
        @auth('teacher')
        @if($FavoriteId)
            <a href="/teacher_del_favorite/{{$y_subject_id}}">
                <span class="material-symbols-outlined favorite-star-icon">star</span>
            </a>
            @else
            <a href="/teacher_add_favorite/{{$y_subject_id}}">
                <!-- 通常の星 -->
            <span class="material-icons">star_border</span>
            </a>

            @endif
        @endauth
        </span>
        <div>
            <div id="sub-page-header">
                <h1 class="page-title-h1">{{$subjectName}}<span class="page-subtitle">({{$teacherName}})</span></h1>
                <div>
                <button id="btn-overview" type="button" style=" font-size:20px; background: none;border: none;padding: 0;margin: 0; font-weight:bold;">概要</button>
                <button id="btn-subject-log" type="button" style=" font-size:20px; background: none;border: none;padding: 0;margin: 0;">授業記録</button>
                </div>
            </div>

              <!-- 概要 -->
              <div id="page-info" class="page-info">
            <table class="overview-table">
                <tr><th>科目名</th><td>{{$subjectName}}</td></tr>
                <tr><th>担当</th><td>{{$teacherName}}</td></tr>
            </table>
        </div>

            <div id="comment" style="width:90%; min-height:75vh;; margin:0 auto; border:1px solid black; border-top:0px; display:none;" class="">
                
                <!-- コメント表示 -->
                <div style="padding:10px; padding-bottom:100px;" class="comment-item">
                    @foreach($tComment as $comment)
                        <div style="margin-bottom:10px;" class="comment-info">
                            <div style="display: flex; align-items: center;">
                                <img src="https://picsum.photos/400/400" alt="アイコン" class="avatar">
                                <h2>
                                    <span class="comment-info-username">{{ optional($comment->Teacher)->name }}</span>
                                    <span class="comment-info-date">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </h2>
                            </div>
                            <button class="material-symbols-outlined comment-more">more_horiz</button>
                            <div class="delete-menu">
                                <button class="confirm-delete">コメントを削除</button>
                            </div>
                        </div>
                        <div style="margin-bottom:10px;" class="comment-value">
                            <!-- <h3 class="comment-title">{{ $comment->title }}</h3> -->
                            <p class="comment-text">
                                @if($comment->link_flg === 0)
                                    <!-- link_flg = 0 なら通常のテキスト -->
                                    {{ $comment->detail }}
                                @else
                                    <!-- link_flg = 1 ならaタグ -->
                                    <a href="{{ $comment->detail }}">{{ $comment->detail }}</a>
                                @endif
                            </p>
                        </div>
                        <!-- 教師なら削除ボタンを表示 -->
                        @if($teacher_id)
                    
                        @endif
                        @endforeach
                    </div>
                        
                    @auth('teacher')

                    <!-- コメント登録フォーム -->
                    <form style="position:fixed; left:303px;  bottom:0px;; width:72%; padding-bottom:20px; padding-left:40px; background-color:#ffffff;" action="/subject_sub" method="post">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                        <input type="hidden" name="y_subject_id" value="{{$y_subject_id}}">
                        
                        <div style="position:relative;" class="">
                            <input style="width:90%;height:60px; font-size:12px; margin-0 auto; border:1px solid black; " type="text" name="text" id="" placeholder="コメントを入力">
                            <label id="label" style="position:absolute; left:10px; bottom:6px; width:30px; height:20px; "><img src="/link.png" alt="" style="height:15px;width:30px"><input style="visibility: hidden;" type="checkbox" name="link_flg" value="1" class="link-checkbox"></label>
                            <button style="position:absolute; right:100px; bottom:15px; background: none;border: none;padding: 0;margin: 0; " type="submit"><img src="/submit.png"  style="height:20px;"alt="" srcset=""></button>
                        </div>
                    </form>
                    @endauth


            </div>
            <script>
  document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.querySelector('.link-checkbox');
    const label = document.querySelector('#label')

    checkbox.addEventListener('change', function () {
      if (checkbox.checked) {
        label.style.backgroundColor = '#3333';
        label.style.borderRadius = '5px';
      } else {
        label.style.backgroundColor = '';
        label.style.borderRadius = '';
      }
    });
  });

  const comment = document.getElementById('comment');
  const pageInfo = document.getElementById('page-info');
const btnOverview = document.getElementById('btn-overview');
const btnSubjectLog = document.getElementById('btn-subject-log');

// 概要ボタンのクリックイベント
btnOverview.addEventListener('click', function () {
  console.log('概要ボタンがクリックされました');
  comment.style.display = 'none';
  pageInfo.style.display = 'block';
  btnOverview.style.fontWeight = 'bold';
  btnSubjectLog.style.fontWeight = 'normal'; // 切り替え感を出すならこちらも
});

// 授業記録ボタンのクリックイベント
btnSubjectLog.addEventListener('click', function () {
    console.log('授業記録ボタンがクリックされました');
    pageInfo.style.display = 'none';
    comment.style.display = 'block';
  btnSubjectLog.style.fontWeight = 'bold';
  btnOverview.style.fontWeight = 'normal'; // 切り替え感を出すならこちらも
});
</script>

@endsection 