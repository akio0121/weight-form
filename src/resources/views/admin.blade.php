<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <title>admin</title>
</head>

<body>
    <button class="btn btn-primary" onclick="location.href='/weight_logs/goal_setting'">目標体重設定</button>
    <button class="btn btn-primary" onclick="location.href='/login'">ログアウト</button>

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
            <td><a href="/weight_logs/{weightLogId}/update">
                    <img src="{{ asset('storage/edit-icon.png') }}" alt="" style="width: 24px; height: 24px;"></a>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- モーダルのトリガーとなるボタン -->
    <button id="openModal" class="btn btn-primary">データ追加</button>

    <!-- モーダル本体 -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2>Weight Logを追加</h2>
            <div class="register-form__inner">
                <form class="register-form__form" action="/weight_logs/create" method="post">
                    @csrf
                    <div class="log-form__group">
                        <label class="log-form__label" for="date">日付</label>
                        <input class="log-form__input" type="date" name="date" id="date">
                        <p class="log-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="weight">体重</label>
                        <input class="log-form__input" type="integer" name="weight" id="weight">kg
                        <p class="log-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="calories">接種カロリー</label>
                        <input class="log-form__input" type="integer" name="calories" id="calories">cal
                        <p class="log-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="exercise_time">運動時間</label>
                        <input class="log-form__input" type="integer" name="exercise_time" id="exercise_time">
                        <p class="log-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="exercise_content">運動内容</label>
                        <input class="log-form__input" type="text" name="exercise_content" id="exercise_content">
                        <p class="log-form__error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <a href="/weight_logs">戻る</a>
                    <input class="log-form__btn btn" type="submit" value="更新">
                </form>
            </div>
        </div>
    </div>

    <style>
        /* モーダルのスタイル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 300%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
    </style>

    <script>
        // モーダルを開くボタン
        document.getElementById("openModal").onclick = function() {
            var modal = document.getElementById("modal");
            modal.style.display = "block";

            // ルーティングでデータを取得して表示する（Ajax使用）
            fetch('/weight_logs/create') // データを取得するURL
                .then(response => response.json())
                .then(data => {
                    document.getElementById("modal-body").innerText = data.message;
                });
        }

        // モーダルを閉じる
        document.getElementById("closeModal").onclick = function() {
            document.getElementById("modal").style.display = "none";
        }

        // モーダルの外側をクリックするとモーダルを閉じる
        window.onclick = function(event) {
            if (event.target == document.getElementById("modal")) {
                document.getElementById("modal").style.display = "none";
            }
        }
    </script>

    {{$weight_logs->links()}}
</body>

</html>