<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/detail.css')}}">
    <title>detail</title>
</head>

<body>
    <button class="btn btn-primary" onclick="location.href='/weight_logs/goal_setting'">目標体重設定</button>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">ログアウト</button>
    </form>
    <h1>Weight Log</h1>

    <form class="detail-form__form" action="/weight_logs/{{ $weightLog->id }}/update" method="post">
        @csrf
        <div>
            <label for="date">日付</label>
            <input type="date" name="date" id="date" value="{{ old('date', $weightLog->date) }}" required>
            <p class="detail-form__error-message">
                @error('date')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div>
            <label for="weight">体重</label>
            <input type="integer" name="weight" id="weight" value="{{$weightLog->weight}}">
        </div>
        <p class="detail-form__error-message">
            @error('weight')
            {{ $message }}
            @enderror
        </p>
        <div>
            <label for="calories">摂取カロリー</label>
            <input type="integer" name="calories" id="calories" value="{{$weightLog->calories}}">
        </div>
        <p class="detail-form__error-message">
            @error('calories')
            {{ $message }}
            @enderror
        </p>
        <div>
            <label for="exercise_time">運動時間</label>
            <input type="time" name="exercise_time" id="exercise_time" value="{{$weightLog->exercise_time}}">
        </div>
        <p class="detail-form__error-message">
            @error('exercise_time')
            {{ $message }}
            @enderror
        </p>
        <div>
            <label for="exercise_content">運動内容</label>
            <input type="text" name="exercise_content" id="exercise_content" value="{{$weightLog->exercise_content}}">
        </div>
        <p class="detail-form__error-message">
            @error('exercise_content')
            {{ $message }}
            @enderror
        </p>

        <button class="btn btn-secondary" type="button" onclick="window.location.href='/weight_logs'">戻る</button>
        <input class=" log-form__btn btn" type="submit" value="更新">

    </form>

    <form action="/weight_logs/{{ $weightLog->id }}/delete" method="post">
        @csrf
        <button type="submit" class="btn btn-danger"><img src="{{ asset('storage/delete-icon.png') }}" alt="" style="width: 24px; height: 24px;"></button>
    </form>

</body>

</html>