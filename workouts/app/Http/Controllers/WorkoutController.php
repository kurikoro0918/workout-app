<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    // 筋トレ記録の一覧を表示（Read）
    public function index()
    {
        $workouts = Workout::all();
        return view('workouts.index', compact('workouts'));
    }

    // 新規作成フォームを表示（Create）
    public function create()
    {
        return view('workouts.create');
    }

    // 新しい記録を保存（Create）
    public function store(Request $request)
    {
        $request->validate([
            'exercise_name' => 'required|max:255',
            'weight' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'sets' => 'nullable|integer',
        ]);

        Workout::create($request->all());

        return redirect()->route('workouts.index')->with('success', '記録が追加されました！');
    }

    // 編集フォームを表示（Update）
    public function edit($id)
    {
        $workout = Workout::findOrFail($id);
        return view('workouts.edit', compact('workout'));
    }

    // 記録を更新（Update）
    public function update(Request $request, $id)
    {
        $request->validate([
            'exercise_name' => 'required|max:255',
            'weight' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'sets' => 'nullable|integer',
        ]);

        $workout = Workout::findOrFail($id);
        $workout->update($request->all());

        return redirect()->route('workouts.index')->with('success', '記録が更新されました！');
    }

    // 記録を削除（Delete）
    public function destroy($id)
    {
        $workout = Workout::findOrFail($id);
        $workout->delete();

        return redirect()->route('workouts.index')->with('success', '記録が削除されました。');
    }
}
