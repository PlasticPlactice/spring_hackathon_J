<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($items as $item)
    <p>{{$item->id}}</p>
    <p>{{$item->name}}</p>
    <p>{{$item->detail}}</p>
    <p>{{$item->tech}}</p>
    @endforeach
</body>
</html>