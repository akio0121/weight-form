<?php

namespace App\Http\Controllers;

use App\Models\Weight_log;
use App\Models\Weight_target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\WeightRequest;
use Carbon\Carbon;

class Weight_logsController extends Controller
{
    //管理画面(admin)を表示する
    public function admin()
    {
        $user = Auth::user();
        Session::put('user_id', $user->id);
        $weight_logs = Weight_log::where('user_id', $user->id)->Paginate(8);
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
        $user = Auth::user();
        $weight_target = new Weight_target();
        $weight_target->user_id = $user->id;
        $weight_target->target_weight = $request->input('target_weight');
        $weight_target->save();
        $weight_log = new Weight_Log();
        $weight_log->user_id = $user->id;
        $weight_log->date = Carbon::now();
        $weight_log->weight = $request->input('weight');
        $weight_log->save();
        return redirect('/weight_logs');
    }

    //体重登録画面を表示する
    public function add()
    {
        return view('create');
    }

    //体重更新画面を表示する
    public function update($weightLogId)
    {
        //未処理
    }
}
