<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    科目サブページ
    <!-- 科目名と教師名の表示 -->
    <p>{{$subjectName}}</p>
    <p>{{$teacherName}}</p>

    <table>
        <!-- コメント表示 -->
        @foreach($tComment as $comment)
            <tr>
                <!-- アイコンのURL -->

                <th>{{$comment->Teacher->name}}</th>
                <td>{{$comment->created_at->format('Y-m-d')}}</td>
            </tr>
            <tr>
                <th>{{$comment->title}}</th>
            </tr>
            <!-- link_flg = 0 なら通常のテキスト -->
            @if($comment->link_flg === 0)
            <tr>
                <th>{{$comment->detail}}</th>
            </tr>
            <!-- link_flg = 1 ならaタグ -->
            @else
            <tr>
                <th><a href="{{$comment->detail}}">{{$comment->detail}}</a></th>
            </tr>
            @endif

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

        <!-- ログインしているのが教師かそれ以外かでフォームの表示を分岐 -->
        @if($teacher_id)
        <!-- コメント登録フォーム -->
        <form action="/subject_sub" method="post">
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
        </form>
        @endif
    </table>
</body>
</html>