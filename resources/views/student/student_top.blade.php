<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    生徒トップ

    <table>
        <tr>
            <td>　</td>
            @foreach($days as $day)
                <td>{{ $day }}</td>
            @endforeach
        </tr>

        @for ($frames = 0; $frames < 4; $frames++)
            <tr>
                <td>{{ $frames + 1 }}限</td>
                @for ($day = 0; $day < 5; $day++)
                    <td>
                        @if(!empty($timeTables[$day + 1][$frames + 1]['title']))
                            {{ $timeTables[$day + 1][$frames + 1]['title'] }}<br>
                        @else
                            -
                        @endif
                    </td>
                @endfor
            </tr>
        @endfor
    </table>
</body>
</html>