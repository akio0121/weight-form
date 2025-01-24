<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/goal.css')}}">
    <title>goal_setting</title>
</head>

<body>
    <div class="goal-form">
        <h1 class="goal-form__heading content__heading">PiGLy</h1>
        <button class="btn btn-primary" onclick="location.href='/weight_logs/goal_setting'">目標体重設定</button>
        <button class="btn btn-primary" onclick="location.href='/login'">ログアウト</button>

        <div class="goal-form__inner">
            <form class="goal-form__form" action="/weight_logs/goal_setting" method="post">
                @csrf
                <div class="goal-form__group">
                    <label class="goal-form__label" for="target_weight">目標体重設定</label>
                    <input class="goal-form__input" type="integer" name="target_weight" id="target_weight">kg
                    <p class="goal-form__error-message">
                        @error('target_weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <button class="btn btn-primary" type="button" onclick="location.href='/weight_logs'">戻る</button>
                <input class="goal-form__btn btn" type="submit" value="更新">
            </form>
        </div>
    </div>
</body>

</html>