@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-page">
    <div class="detail-card">
        <h1 class="detail-title">Weight Log</h1>

        <form class="detail-form__form"
            action="/weight_logs/{{ $weightLog->id }}/update" method="post">
            @csrf

            <div class="detail-form__group">
                <label for="date">日付</label>
                <input type="date" name="date" id="date"
                    value="{{ old('date', $weightLog->date) }}">
                <p class="detail-form__error-message">
                    @error('date') {{ $message }} @enderror
                </p>
            </div>

            <div class="detail-form__group">
                <label for="weight">体重</label>
                <input type="number" name="weight" id="weight"
                    value="{{ $weightLog->weight }}">
            </div>

            <div class="detail-form__group">
                <label for="calories">摂取カロリー</label>
                <input type="number" name="calories" id="calories"
                    value="{{ $weightLog->calories }}">
            </div>

            <div class="detail-form__group">
                <label for="exercise_time">運動時間</label>
                <input type="time" name="exercise_time" id="exercise_time"
                    value="{{ $weightLog->exercise_time }}">
            </div>

            <div class="detail-form__group">
                <label for="exercise_content">運動内容</label>
                <input type="text" name="exercise_content" id="exercise_content"
                    value="{{ $weightLog->exercise_content }}">
            </div>

            <div class="detail-form__buttons">
                <button class="btn btn-secondary" type="button"
                    onclick="location.href='/weight_logs'">戻る</button>
                <input class="btn btn-primary" type="submit" value="更新">
            </div>
        </form>

        <form class="detail-delete"
            action="/weight_logs/{{ $weightLog->id }}/delete" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">
                <img src="{{ asset('storage/delete-icon.png') }}" alt="" width="24">
            </button>
        </form>
    </div>
</div>
@endsection