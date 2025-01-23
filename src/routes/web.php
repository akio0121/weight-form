<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Weight_logsController;
use App\Http\Middleware\StoreUserId;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//会員登録画面を表示するために、UserControllerのindexメソッドを実行する
Route::get('/register/step1', [UserController::class, 'step1']);

//会員登録画面(step1)で氏名、メールアドレス、パスワードを登録する
Route::post('/register/step1', [UserController::class, 'create']);

//ログイン画面を表示するために、UserControllerのloginメソッドを実行する
Route::get('/login', [UserController::class, 'login']);

//step1でアカウント情報を登録後、step2へ遷移
Route::get('register/step2', [UserController::class, 'step2']);

//会員登録画面(step2)で体重を登録し、管理画面へ遷移する
Route::post('/register/step2', [Weight_logsController::class, 'create2']);

//ログイン画面でログイン後、管理画面へ遷移
Route::get('/weight_logs', [Weight_logsController::class, 'admin']);

//管理画面から目標体重設定ボタンを押下して、目標設定画面へ遷移
Route::get('/weight_logs/goal_setting', [Weight_logsController::class, 'goal_setting']);

//目標体重設定画面から、目標体重を更新する
Route::post('/weight_logs/goal_setting', [Weight_logsController::class, 'goal_setting_update']);

//管理画面からデータ追加ボタンを押下して、体重登録画面へ遷移
Route::get('weight_logs/create', [Weight_logsController::class, 'add']);

//管理画面から鉛筆マークを押下して、体重詳細画面へ遷移
Route::get('/weight_logs/{weightLogId}', [Weight_logsController::class, 'detail'])
    ->where('weightLogId', '[0-9]+')
    ->name('weight_logs.detail');



Route::get('/', function () {
    return view('welcome');
});
