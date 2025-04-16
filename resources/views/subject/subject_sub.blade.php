<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    科目サブページ
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
            <!-- link_flgが0なら通常のテキスト -->
            @if($comment->link_flg === 0)
            <tr>
                <th>{{$comment->detail}}</th>
            </tr>
            <!-- falseならaタグ -->
            @else
            <tr>
                <th><a href="{{$comment->detail}}">{{$comment->detail}}</a></th>
            </tr>
            @endif
        @endforeach
        <!-- ここまで -->

        <!-- コメント登録フォーム -->
        <form action="/subject_sub" method="post">
            @csrf
            <tr>
                <td><input type="hidden" name="teacher_id" value="{{$teacher_id}}"></td>
                <td><input type="hidden" name="y_subject_id" value="{{$y_subject_id}}"></td>
            </tr>
            <tr>
                <td><p>タイトル</p></td>
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
                <td>
                    <input type="submit" value="送信">
                </td>
            </tr>
        </form>
        <!-- ここまで -->
    </table>
</body>
</html>