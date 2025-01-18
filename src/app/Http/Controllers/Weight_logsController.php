<?php

namespace App\Http\Controllers;

use App\Models\Weight_log;
use Illuminate\Http\Request;
use App\Http\Requests\WeightRequest;

class Weight_logsController extends Controller
{
    //管理画面(admin)を表示する
    public function admin()
    {
        $weight_logs = Weight_log::Paginate(8);
        return view('admin', ['weight_logs' => $weight_logs]);
    }

    //目標設定画面(goal_setting)を表示する
    public function goal_setting()
    {
        return view('goal_setting');
    }

    //会員登録画面(step2)で体重を入力後、体重管理画面(admin)へ遷移する
    public function create2(WeightRequest $request)
    {
        return redirect('/admin');
    }
}
