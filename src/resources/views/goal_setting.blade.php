@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal.css')}}">
@endsection

@section('content')
<div class="goal-form">
    <div class="goal-form__inner">
        <form class="goal-form__form" action="/weight_logs/goal_setting" method="post">
            @csrf
            <div class="goal-form__group">
                <label class="goal-form__label" for="target_weight">目標体重設定</label>

                <div class="goal-form__input-wrapper">
                    <input class="goal-form__input" type="number" name="target_weight" id="target_weight">
                    <span>kg</span>
                </div>
                <p class="goal-form__error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="goal-form__buttons">
                <button class="btn btn-primary" type="button" onclick="location.href='/weight_logs'">戻る</button>
                <input class="goal-form__btn btn" type="submit" value="更新">
            </div>
        </form>
    </div>
</div>
@endsection