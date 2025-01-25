<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    //会員登録画面(step1)を表示
    public function step1()
    {
        return view('auth.register');
    }

    //会員登録画面(step1)画面で氏名、メールアドレス、パスワードを入力後、会員登録画面(step2)へ遷移
    public function create(UserRequest $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect('register/step2');
    }

    //ログイン画面を表示
    public function login()
    {
        return view('auth.login');
    }

    //step2画面を表示
    public function step2()
    {
        return view('step2');
    }

    //ログアウトボタンを押して、ログアウト
    public function logout()
    {
        //ログアウト時に、検索条件をリセット
        session()->forget(['isSearch', 'start_date', 'end_date']);
        Auth::logout();
        return redirect('/login');
    }
}
