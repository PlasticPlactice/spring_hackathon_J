<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    個別時間割の作成(履修登録)画面
    <form action="/personal_timetable_register" method="post">
        @csrf
        <table>
            <tr>
                <th>科目</th>
                <td>
                    <select name="course_list_id">
                        @foreach ($CourseLists as $CourseList)
                            <option value="{{$CourseList->id}}">
                                {{$CourseList->title}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr><td><input type="submit" value="作成"></td></tr>
        </table>
    </form>
</body>
</html>