<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <title>admin</title>
    <style>
        /* モーダルの背景 */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        /* モーダルウィンドウ */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }

        /* モーダルを表示するためのチェックボックス */
        #modalToggle:checked~.modal-overlay,
        #modalToggle:checked~.modal {
            display: block;
        }

        /* 閉じるボタン */
        .close-btn {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            cursor: pointer;
        }

        .close-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <p>目標体重: {{ $weight_target->target_weight }} kg</p>
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
            <td><a href="/weight_logs/{{$weight_log->id}}">
                    <img src="{{ asset('storage/edit-icon.png') }}" alt="" style="width: 24px; height: 24px;"></a>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="container">
        <h1>CSSだけでモーダルウィンドウを作成</h1>

        <!-- モーダルを開くトリガー -->
        <label for="modalToggle" class="btn btn-primary" style="cursor: pointer;">モーダルを開く</label>
        <input type="checkbox" id="modalToggle" style="display: none;">

        <!-- モーダルの背景 -->
        <div class="modal-overlay"></div>

        <!-- モーダルウィンドウ -->
        <div class="modal">
            <h2>モーダルウィンドウ</h2>
            <form class="register-form__form" action="/weight_logs" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">名前:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">送信</button>
            </form>
            <a href="#" class="close-btn" onclick="document.getElementById('modalToggle').checked = false;">閉じる</a>
        </div>
    </div>





    <!-- モーダルのトリガーとなるボタン -->
    <button id="openModal" class="btn btn-primary">デー</button>

    <!-- モーダル本体 -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2>Weight Logを追加</h2>
            <div class="register-form__inner">
                <form class="register-form__form" action="/weight_logs" method="post">
                    @csrf
                    <div class="log-form__group">
                        <label class="log-form__label" for="date">日付</label>
                        <span class="form__label--required">必須</span>
                        <input class="log-form__input" type="date" name="date" id="date">
                        <p class="log-form__error-message">
                            @error('date')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="weight">体重</label>
                        <span class="form__label--required">必須</span>
                        <input class="log-form__input" type="integer" name="weight" id="weight">kg
                        <p class="log-form__error-message">
                            @error('weight')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="calories">摂取カロリー</label>
                        <span class="form__label--required">必須</span>
                        <input class="log-form__input" type="integer" name="calories" id="calories">cal
                        <p class="log-form__error-message">
                            @error('calories')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="exercise_time">運動時間</label>
                        <span class="form__label--required">必須</span>
                        <input class="log-form__input" type="time" name="exercise_time" id="exercise_time">
                        <p class="log-form__error-message">
                            @error('exercise_time')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="log-form__group">
                        <label class="log-form__label" for="exercise_content">運動内容</label>
                        <input class="log-form__input" type="text" name="exercise_content" id="exercise_content">
                        <p class="log-form__error-message">
                            @error('exercise_content')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <button class="btn btn-secondary" type="button" onclick="window.location.href='/weight_logs'">戻る</button>
                    <input class=" log-form__btn btn" type="submit" value="更新">
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
            fetch('/weight_logs') // データを取得するURL
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