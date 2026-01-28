<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/weight_logs">
                    PiGLy
                </a>
                <nav>
                    <ul class="header-weight">
                        <li class="header-weight__item">
                            <button class="btn btn-primary" onclick="location.href='/weight_logs/goal_setting'">目標体重設定</button>
                        </li>
                    </ul>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">ログアウト</button>
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>