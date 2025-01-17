<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //会員登録画面(step1)を表示する
    public function step1()
    {
        return view('auth.register');
    }

    //会員登録画面(step1)画面で、アカウント情報を登録後、会員登録画面(step2)へ遷移する
    public function create(UserRequest $request)
    {
        $form = $request->all();
        User::create($form);
        return redirect('register/step2');
    }

    //ログイン画面を表示する
    public function login()
    {
        return view('auth.login');
    }

    //step2画面へ遷移する
    public function step2()
    {
        return view('step2');
    }
}
