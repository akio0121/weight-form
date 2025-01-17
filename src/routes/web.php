<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

//会員登録画面でアカウント情報を登録する
Route::post('/register/step1', [UserController::class, 'create']);

//ログイン画面を表示するために、UserControllerのloginメソッドを実行する
Route::get('/login', [UserController::class, 'login']);

//step1でアカウント情報を登録後、step2へ遷移
Route::get('register/step2', [UserController::class, 'step2']);

Route::get('/', function () {
    return view('welcome');
});
