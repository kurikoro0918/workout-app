<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    // ログインユーザーの筋トレ記録一覧を表示
    public function index()
    {
        $workouts = Auth::user()->workouts()->orderBy('created_at', 'desc')->get();
        return view('workouts.index', compact('workouts'));
    }

    // 新規作成フォームを表示
    public function create()
    {
        return view('workouts.create');
    }

    // 新しい記録を保存
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exercise_name' => 'required|max:255',
            'weight' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'sets' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        Auth::user()->workouts()->create($validated);

        return redirect()->route('workouts.index')->with('success', '記録が追加されました！');
    }

    // 編集フォームを表示
    public function edit(Workout $workout)
    {
        // 他のユーザーの記録を編集できないようチェック
        if ($workout->user_id !== Auth::id()) {
            return redirect()->route('workouts.index')->with('error', 'この記録は編集できません。');
        }

        return view('workouts.edit', compact('workout'));
    }

    // 記録を更新
    public function update(Request $request, Workout $workout)
    {
        if ($workout->user_id !== Auth::id()) {
            return redirect()->route('workouts.index')->with('error', 'この記録は更新できません。');
        }

        $validated = $request->validate([
            'exercise_name' => 'required|max:255',
            'weight' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'sets' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        $workout->update($validated);

        return redirect()->route('workouts.index')->with('success', '記録が更新されました！');
    }

    // 記録を削除
    public function destroy(Workout $workout)
    {
        if ($workout->user_id !== Auth::id()) {
            return redirect()->route('workouts.index')->with('error', 'この記録は削除できません。');
        }

        $workout->delete();

        return redirect()->route('workouts.index')->with('success', '記録が削除されました。');
    }
}
