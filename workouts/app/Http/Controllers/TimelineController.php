<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    // 全ユーザーの筋トレ記録をタイムライン形式で表示
    public function index()
    {
        // 全てのWorkoutレコードを新しい順に取得
        // with('user')で投稿したユーザー情報も同時にロード
        $workouts = Workout::with('user')->orderBy('created_at', 'desc')->get();
        return view('timeline.index', compact('workouts'));
    }
}
