@extends('layouts.base')
@section('title','科目サブページ')
@section('external_css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=more_horiz" />
    <link rel="stylesheet" href="{{asset('css/shibaya_style.css')}}">
@endsection

@component('components.side_bar')
@endcomponent
@section('content')
    <div id="subject-sub-container">
        <div>
            <div id="sub-page-header">
                <h1 class="page-title-h1">{{$subjectName}}<span class="page-subtitle">({{$teacherName}})</span></h1>
                <div>
                    <a href="subject_sub_result_info">概要</a>
                    <p>授業記録</p>
                </div>
            </div>

            <!-- コメント表示 -->
            <div class="comment-item">
                <div class="comment-info">
                    <div>
                        <img src="https://picsum.photos/400/400" alt="アイコン" class="avatar">
                        <h2>
                            <span class="comment-info-username">sato</span>
                            <span class="comment-info-date">2025/1/13 12:00</span>
                        </h2>
                    </div>
                    <button class="material-symbols-outlined comment-more">more_horiz</button>
                    <div class="delete-menu">
                        <button class="confirm-delete">コメントを削除</button>
                    </div>
                </div>

                <div class="comment-value">
                    <h3 class="comment-title">ダミーコメント</h3>
                    <p class="comment-text">授業の内容が分かりやすい</p>
                </div>
            </div>

            @foreach($tComment as $comment)
                <div class="comment-item">
                    <div class="comment-info">
                        <div>
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

                    <div class="comment-value">
                        <h3 class="comment-title">{{ $comment->title }}</h3>
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
                </div>
                <!-- 教師なら削除ボタンを表示 -->
                @if($teacher_id)
                <tr>
                    <td>
                        <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <!-- 必要なデータの受け渡し -->
                        <input type="hidden" value="{{$y_subject_id}}" name="y_subject_id">
                        <input type="hidden" value="{{$comment->id}}" name="comment_id">
                        <!-- 削除ボタン -->
                        <input type="submit" value="削除">
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach

        <!-- コメント登録フォーム -->
        <form action="/subject_sub" method="post">
            <table>
            @csrf
            <!-- ほかの処理に必要なidを渡してます -->
            <tr>
                <td><input type="hidden" name="teacher_id" value="{{$teacher_id}}"></td>
                <td><input type="hidden" name="y_subject_id" value="{{$y_subject_id}}"></td>
            </tr>
            <!-- 投稿フォーム -->
            <tr>
                <td>タイトル</td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td>内容</td>
                <td><input type="text" name="detail"></td>
            </tr>
            <tr>
                <td><input type="radio" name="link_flg" value="0" checked></td>
                <td><label for="link_flg">テキストにする</label></td>
            </tr>
            <tr>
                <td><input type="radio" name="link_flg" value="1"></td>
                <td><label for="link_flg">リンクにする</label></td>
            </tr>
            <tr>
                <td><input type="submit" value="送信"></td>
            </tr>
            </table>
        </form>
        <!-- ここまで -->
    </table>
</body>
<script src="/js/subject_sub.js"></script>
</html>