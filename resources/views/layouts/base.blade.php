<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('external_css')
    <link rel="stylesheet" href="/css/all-style.css">
</head>
<body>
    <nav id="side-bar">
        <h1 id="app-name">ABCDE</h1>

        @yield('side_bar_content')

        <div id="user-section">
            <img src="https://picsum.photos/400/400" id="user-icon" title="ユーザーメニューを開く" tabindex="0">
            
            <div id="user-menu">
                <input type="file" id="user-icon-input" accept="image/*" style="display:none">

                <li><a href="#" id="user-icon-change">アイコン変更</a></li>
                <li><a href="#">パスワード変更</a></li>
                <li><a href="#" class="text-red">ログアウト</a></li>
            </div>
        </div>
    </nav>
    <div id="page-content">
        @yield('content')
    </div>

    @yield('js')

    <script src="/js/base.js"></script>
</body>
</html>
