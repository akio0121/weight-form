<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/detail.css')}}">
    <title>admin</title>
</head>

<body>
    <button class="btn btn-primary" onclick="location.href='/weight_logs/goal_setting'">目標体重設定</button>
    <button class="btn btn-primary" onclick="location.href='/login'">ログアウト</button>

    <h1>Weight Log</h1>

    <div>
        <label for="date">日付</label>
        <input type="date" name="date" id="date" value="{{ $weightLog->date }}" required>
    </div>
    <div>
        <label for="weight">体重</label>
        <input type="integer" name="weight" id="weight" value="{{ $weightLog->weight }}" required>
    </div>
    <div>
        <label for="calories">摂取カロリー</label>
        <input type="integer" name="calories" id="calories" value="{{ $weightLog->calories }}" required>
    </div>
    <div>
        <label for="exercise_time">運動時間</label>
        <input type="time" name="exercise_time" id="exercise_time" value="{{ $weightLog->exercise_time }}" required>
    </div>
    <div>
        <label for="exercise_content">運動内容</label>
        <input type="text" name="exercise_content" id="exercise_content" value="{{ $weightLog->exercise_content }}" required>
    </div>
    <button class="btn btn-primary" onclick="location.href='/weight_logs'">戻る</button>
    <input class="log-form__btn btn" type="submit" value="更新">
</body>

</html>