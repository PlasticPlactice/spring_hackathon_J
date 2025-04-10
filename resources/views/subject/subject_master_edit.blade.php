<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    マスタマスタ編集・削除画面
    <form action='/subject_master_edit' method='post'>
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">
            <tr>
                <th>name</th>
                <td><input type="text" name="name" value='{{$form->name}}'></td>
            </tr>
            <tr>
                <th>detail</th>
                <td><input type="text" name="detail" value='{{$form->detail}}'></td>
            </tr>
            <tr>
                <th>tech</th>
                <td><input type="text" name="tech" value='{{$form->tech}}'></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="action" value="update"></td>
                <td colspan="2"><input type="submit" name="action" value="delete"></td>
            </tr>
        </table>
    </form>
</body>
</html>