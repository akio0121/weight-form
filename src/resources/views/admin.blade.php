<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <title>admin</title>
</head>

<body>
    <a href="/weight_logs/goal_setting">目標体重設定</a>
    <a href="/login">ログアウト</a>
    <a href="/weight_logs/create">データ追加</a>

    <table>
        <tr>
            <th>日付</th>
            <th>体重</th>
            <th>食事摂取カロリー</th>
            <th>運動時間</th>
        </tr>
        @foreach ($weight_logs as $weight_log)
        <tr>
            <td>{{$weight_log->date}}</td>
            <td>{{$weight_log->weight}}kg</td>
            <td>{{$weight_log->calories}}cal</td>
            <td>{{$weight_log->exercise_time}}</td>
        </tr>
        @endforeach
    </table>

    {{$weight_logs->links()}}
</body>

</html>