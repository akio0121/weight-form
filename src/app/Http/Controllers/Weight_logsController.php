<?php

namespace App\Http\Controllers;

use App\Models\Weight_log;
use App\Models\Weight_target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightRequest;
use Carbon\Carbon;

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

        /*$user = Auth::user();
        $weight_target = new Weight_target;
        $weight_target->user_id = $user->id;
        $weight_target->target_weight = $request->input('target_weight');
        $weight_target->save();
        $weight_logs = new Weight_log;
        $weight_logs->user_id = $user->id;
        $weight_logs->weight = $request->input('weight');
        $weight_logs->date = Carbon::now();
        $weight_logs->save();
        return view('admin');*/
        return view('step1');
    }

    //体重登録画面を追加する
    public function add()
    {
        return view('create');
    }
}
