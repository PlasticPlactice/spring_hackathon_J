<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    今季履修可能科目登録画面


    <form action="/available_subject_register" method="post">
        @csrf
        <table>
            <tr>
                <th>科目名</th>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <th>教師名</th>
                <td>
                    <select name="teacher_id">
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{$teacher->name}}
                        </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>年度</th>
                <td><input type="text" name="year"></td>
            </tr>
            <tr>
                <th>前期/後期</th>
                <td>
                    <select name="session_flg">
                        <option value="0">前期</option>
                        <option value="1">後期</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>科目マスタ</th>
                <td>
                    <select name="subject_id">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{$subject->name}}
                        </option>
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="送信"></td>
            </tr>
        </table>
    </form>
</body>
</html>