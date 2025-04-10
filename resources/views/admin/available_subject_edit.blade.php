<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    今季履修可能科目編集・削除画面
    <form action='/available_subject_edit' method='post'>
        <table>
            @csrf
                <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>id</th>
                <td><input type="text" name="teacher_id" value='{{$form->teacher_id}}'></td>
            </tr>
            <tr>
                <th>title</th>
                <td><input type="text" name="title" value='{{$form->title}}'></td>
            </tr>
            <tr>
                <th>year</th>
                <td><input type="text" name="year" value='{{$form->year}}'></td>
            </tr>
            <tr>
                <th>前期/後期</th>
                <td><input type="hidden" name="session_flg" value="0"></td>
                <td><input type="checkbox" name="session_flg" value="1" id="session_flg"
                    {{ old('session_flg', $form->session_flg) == 1 ? 'checked' : '' }}></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="action" value="update"></td>
                <td colspan="2"><input type="submit" name="action" value="delete"></td>
            </tr>
        </table>
    </form>
</body>
</html>