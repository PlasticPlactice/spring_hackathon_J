<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    マスタ登録画面

    <form action='/subject_master_register' method='post'>
        <table>
            @csrf
            <tr>
                <th>name</th>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <th>detail</th>
                <td><input type="text" name="detail"></td>
            </tr>
            <tr>
                <th>tech</th>
                <td><input type="text" name="tech"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="send"></td>
            </tr>
        </table>
    </form>
</body>
</html>