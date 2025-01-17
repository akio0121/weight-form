<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <div class="login-form">
        <h1 class="login-form__heading content__heading">PiGLy</h1>
        <h2>ログイン</h2>
        <div class="login-form__inner">
            <form class="login-form__form" action="/login" method="post">
                @csrf
                <div class="login-form__group">
                    <label class="login-form__label" for="email">メールアドレス</label>
                    <input class="login-form__input" type="mail" name="email" id="email" placeholder="メールアドレスを入力">
                    <p class="login-form__error-message">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="login-form__group">
                    <label class="login-form__label" for="password">パスワード</label>
                    <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワードを入力">
                    <p class="login-form__error-message">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <input class="login-form__btn btn" type="submit" value="ログイン">
                <a href="/register/step1">アカウント作成はこちら</a>
            </form>
        </div>
    </div>
</body>

</html>