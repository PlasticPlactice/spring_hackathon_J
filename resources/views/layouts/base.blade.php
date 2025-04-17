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
        <h1 style="margin-bottom:10px!important;" id="app-name">ABCDE</h1>

        @yield('side_bar_content')

        <div id="user-section">
            <img src="https://picsum.photos/400/400" id="user-icon" title="ユーザーメニューを開く" tabindex="0">
            
            <div id="user-menu">
                <input type="file" id="user-icon-input" accept="image/*" style="display:none">

                <li><a href="#" id="user-icon-change">アイコン変更</a></li>
                @auth('admin')
              
                @endauth
                
                @auth('teacher')
                <li><a href="/teacher_password_change">パスワード変更</a></li>
                @endauth
                @auth('student')
                <li><a href="/student_password_change">パスワード変更</a></li>
                @endauth
                <li><a href="/logout" class="text-red">ログアウト</a></li>
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
