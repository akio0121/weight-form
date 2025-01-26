<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/step2.css')}}">
    <title>step2</title>
</head>

<body>
    <div class="step2-form">
        <h1 class="step2-form__heading content__heading">PiGLy</h1>
        <h2>新規会員登録</h2>
        <p>STEP2 体重データの入力</p>
        <div class="step2-form__inner">
            <form class="step2-form__form" action="/register/step2" method="post">
                @csrf
                <div class="step2-form__group">
                    <label class="step2-form__label" for="weight">現在の体重</label>
                    <input class="step2-form__input" type="integer" name="weight" id="weight" placeholder="現在の体重を入力">kg
                    <p class="step2-form__error-message">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="step2-form__group">
                    <label class="step2-form__label" for="target_weight">目標の体重</label>
                    <input class="step2-form__input" type="integer" name="target_weight" id="target_weight" placeholder="目標の体重を入力">kg
                    <p class="step2-form__error-message">
                        @error('target_weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <input class="step2-form__btn btn" type="submit" value="アカウント作成">
            </form>
        </div>
    </div>
</body>

</html>