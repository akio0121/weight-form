<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\WeightRequest;
use App\Http\Requests\LogRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WeightLogsController extends Controller
{
    //管理画面(admin)を表示
    public function admin()
    {
        //管理画面に体重一覧を表示
        $user = Auth::user();
        Session::put('user_id', $user->id);
        $weight_logs = WeightLog::where('user_id', $user->id)->Paginate(8);
        //管理画面上部に目標体重を表示
        $weight_target = WeightTarget::where('user_id', $user->id)->first();
        //管理画面上部に最新体重を表示
        $latestWeightLog = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->first();
        return view('admin', compact('weight_target', 'weight_logs', 'latestWeightLog'));
    }

    //目標設定画面(goal_setting)を表示
    public function goal_setting()
    {
        return view('goal_setting');
    }

    //目標設定画面で目標体重(target_weight)を更新
    public function goal_setting_update(WeightRequest $request)
    {
        $user = Auth::user();
        $weight_target = WeightTarget::where('user_id', $user->id)->first();
        if ($weight_target) {
            // レコードが見つかった場合、target_weight を更新
            $weight_target->target_weight = $request->input('target_weight');
            $weight_target->save();

            return redirect('/weight_logs');
        } else {
            // レコードが存在しない場合、新規作成
            WeightTarget::create([
                'user_id' => $user->id,
                'target_weight' => $request->input('target_weight'),
            ]);

            return redirect('/weight_logs');
        }
    }


    //会員登録画面(step2)で体重を入力後、体重管理画面(admin)へ遷移
    public function create2(WeightRequest $request)
    {
        $user = Auth::user();
        $weight_target = new WeightTarget();
        $weight_target->user_id = $user->id;
        $weight_target->target_weight = $request->input('target_weight');
        $weight_target->save();
        $weight_log = new WeightLog();
        $weight_log->user_id = $user->id;
        $weight_log->date = Carbon::now();
        $weight_log->weight = $request->input('weight');
        $weight_log->save();
        return redirect('/weight_logs');
    }

    //体重詳細画面を表示
    public function detail(WeightLog $weightLogId)
    {
        return view('detail', ['weightLog' => $weightLogId]);
    }

    //体重登録画面へ遷移し、weight_logテーブルにデータを追加する
    public function store(LogRequest $request)
    {
        $user = Auth::user();
        $weight_log = new WeightLog();
        $weight_log->user_id = $user->id;
        $weight_log->date = $request->input('date');
        $weight_log->weight = $request->input('weight');
        $weight_log->calories = $request->input('calories');
        $weight_log->exercise_time = $request->input('exercise_time');
        $weight_log->exercise_content = $request->input('exercise_content');
        $weight_log->save();
        return redirect('/weight_logs');
    }

    //体重詳細画面の更新ボタンを押下して、weight_logsテーブルのデータを更新する
    public function update(LogRequest $request, $weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->date = $request->input('date');
        $weightLog->weight = $request->input('weight');
        $weightLog->calories = $request->input('calories');
        $weightLog->exercise_time = $request->input('exercise_time');
        $weightLog->exercise_content = $request->input('exercise_content');
        $weightLog->save();
        return redirect('/weight_logs');
    }

    //体重詳細画面のゴミ箱ボタンを押下して、weight_logsテーブルのデータを削除する
    public function delete(Request $request, $weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->delete();
        return redirect('/weight_logs');
    }

    //管理画面から検索ボタンを押下して、選択した期間内のデータを検索
    public function search(Request $request)

    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $weightLogs = WeightLog::whereBetween('date', [$startDate, $endDate])->get();
        return view('admin', ['weightLogs' => $weightLogs,]);
    }
}
