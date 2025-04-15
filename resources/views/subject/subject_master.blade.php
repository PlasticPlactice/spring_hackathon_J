<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    科目マスターページ
    <!-- 科目情報の表示 -->
    <div>
        <!-- idは必要ないから消してok -->
        <p>{{$item->id}}</p>
        <!-- name detail techは消さない -->
        <p>{{$item->name}}</p>
        <p>{{$item->detail}}</p>
        <p>{{$item->tech}}</p>
    </div>
    <!-- ここまで -->

    <table>
        <!-- コメント表示 -->
        @foreach($comments as $comment)
            <tr>
                <!-- アイコンのURL -->
                <!-- <td><img src="{{ asset($comment->student->img_path) }}" alt="アイコン画像" style="width: 20px; height: 20px;"></td> -->
                <th>{{$comment->Student->name}}</th>
                <td>{{$comment->created_at->format('Y-m-d')}}</td>
            </tr>
            <tr>
                <th>{{$comment->title}}</th>
            </tr>
            <tr>
                <th>{{$comment->detail}}</th>
            </tr>
        @endforeach
        <!-- ここまで -->

        <!-- コメント登録フォーム -->
        <form action="/subject_master" method="post">
            @csrf
            <tr>
                <td><input type="hidden" name="subject_id" value="{{$subject_id}}"></td>
            </tr>
            <tr>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td><input type="text" name="detail"></td>
            </tr>
            <tr>
                <td><input type="submit" value="送信"></td>
            </tr>
        </form>
        <!-- ここまで -->
    </table>
</body>
</html>