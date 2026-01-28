@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
@endsection

@section('content')
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

    /* ホバー時の行強調表示 */
    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<body>
    <div class="admin-page">
        <div class="summary-area">
            <div class="summary-cards">
                <div class="summary-card">
                    <p class="summary-title">目標体重</p>
                    <p class="summary-value">{{ $weight_target->target_weight }} kg</p>
                </div>

                <div class="summary-card">
                    <p class="summary-title">目標まで</p>
                    <p class="summary-value">
                        {{ $weight_target->target_weight - $latestWeightLog->weight }} kg
                    </p>
                </div>

                <div class="summary-card">
                    <p class="summary-title">最新体重</p>
                    <p class="summary-value">{{ $latestWeightLog->weight }} kg</p>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="search-header">
                <form action="/weight_logs/search" method="GET" class="search-form">
                    <input class="search-input" type="date" name="start_date" id="start_date" value="{{ old('start_date', $start_date ?? '') }}">

                    <span class="search-separator">～</span>

                    <input class="search-input" type="date" name="end_date" id="end_date" value="{{ old('end_date', $end_date ?? '') }}">

                    <button type="submit" class="search-btn">検索</button>
                </form>

                @if ($isSearch)
                <div class="search-result">
                    <p>{{ $start_date }}～{{ $end_date }}の検索結果 {{ $weight_logs->total() }}件</p>
                    <form action="/weight_logs" method="GET">
                        <button type="submit" class="reset-btn">リセット</button>
                    </form>
                </div>
                @endif
                <!-- モーダルを開くトリガー -->
                <button type="button"
                    class="btn btn-primary add-btn"
                    onclick="document.getElementById('modalToggle').checked = true;">
                    データ追加
                </button>

                <input type="checkbox" id="modalToggle" style="display: none;" @if ($errors->any()) checked @endif>


                <!-- モーダルの背景 -->
                <div class="modal-overlay"></div>

                <!-- モーダルウィンドウ -->
                <div class="modal">
                    <h2>Weight Logを追加</h2>
                    <form class="register-form__form" action="/weight_logs" method="post">
                        @csrf
                        <div class="log-form__group">
                            <label class="log-form__label" for="date">日付</label>
                            <span class="form__label--required">必須</span>
                            <input class="log-form__input" type="date" name="date" id="date" value="{{ date('Y-m-d') }}">
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
                            <textarea class="log-form__input2" type="text" name="exercise_content" id="exercise_content"></textarea>
                            <p class="log-form__error-message">
                                @error('exercise_content')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <button class="btn btn-secondary" type="button" onclick="window.location.href='/weight_logs'">戻る</button>
                        <input class=" log-form__btn btn" type="submit" value="登録">
                    </form>
                </div>
            </div>

            <table class="log-table">
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                </tr>
                @foreach ($weight_logs as $weight_log)
                <tr>
                    <td>{{ $weight_log->date ? \Carbon\Carbon::parse($weight_log->date)->format('Y/m/d') : '' }}</td>
                    <td>{{$weight_log->weight}}kg</td>
                    <td>{{$weight_log->calories}}cal</td>
                    <td>{{ $weight_log->exercise_time ? \Carbon\Carbon::parse($weight_log->exercise_time)->format('H:i') : '' }}</td>
                    <td><a href="/weight_logs/{{$weight_log->id}}">
                            <img src="{{ asset('storage/edit-icon.png') }}" alt="" style="width: 24px; height: 24px;"></a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="pagination-wrapper">
                {{ $weight_logs->withQueryString()->links() }}
            </div>
        </div>
    </div>
</body>
@endsection