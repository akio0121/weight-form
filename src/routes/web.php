<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightLogsController;
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
//会員登録画面を表示するために、UserControllerのindexメソッドを実行
Route::get('/register/step1', [UserController::class, 'step1']);

//会員登録画面(step1)で氏名、メールアドレス、パスワードを登録
Route::post('/register/step1', [UserController::class, 'create']);

//ログイン画面を表示するために、UserControllerのloginメソッドを実行
Route::get('/login', [UserController::class, 'login']);

//step1でアカウント情報を登録後、step2へ遷移
Route::get('register/step2', [UserController::class, 'step2']);

//会員登録画面(step2)で体重を登録し、管理画面へ遷移
Route::post('/register/step2', [WeightLogsController::class, 'create2']);

//ログイン画面でログイン後、管理画面へ遷移
Route::get('/weight_logs', [WeightLogsController::class, 'admin']);

//管理画面のデータ追加ボタンを押下して、モーダルウィンドウを表示
Route::post('/weight_logs', [WeightLogsController::class, 'store']);

//管理画面から目標体重設定ボタンを押下して、目標設定画面へ遷移
Route::get('/weight_logs/goal_setting', [WeightLogsController::class, 'goal_setting']);

//目標体重設定画面から、目標体重を更新
Route::post('/weight_logs/goal_setting', [WeightLogsController::class, 'goal_setting_update']);

//管理画面から鉛筆マークを押下して、体重詳細画面へ遷移
Route::get('/weight_logs/{weightLogId}', [WeightLogsController::class, 'detail'])
    ->where('weightLogId', '[0-9]+')
    ->name('weight_logs.detail');

//体重詳細画面で更新ボタンを押下して、weight_logsテーブルのデータを更新
Route::post('/weight_logs/{weightLogId}/update', [WeightLogsController::class, 'update'])
    ->where('weightLogId', '[0-9]+')
    ->name('weight_logs.update');

//体重詳細画面でゴミ箱ボタンを押下して、weight_logsテーブルのデータを削除
Route::post('/weight_logs/{weightLogId}/delete', [WeightLogsController::class, 'delete'])
    ->where('weightLogId', '[0-9]+')
    ->name('weight_logs.delete');

//管理画面から検索ボタンを押下して、選択した期間内のデータを検索し、検索ボタン、検索件数、検索期間を表示
Route::get('/weight_logs/search', [WeightLogsController::class, 'admin']);



Route::get('/', function () {
    return view('welcome');
});
