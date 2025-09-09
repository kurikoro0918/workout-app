<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // 全ユーザーの公開プロフィール一覧ページ（※現在はタイムラインに置き換え済み）
    public function index()
    {
        $users = User::withCount('workouts')->get();
        return view('profiles.index', compact('users'));
    }

    // 特定のユーザーのプロフィールページを表示
    public function show(User $user)
    {
        $workouts = $user->workouts()->orderBy('created_at', 'desc')->get();
        return view('profiles.show', compact('user', 'workouts'));
    }

    // ログインユーザーのプロフィール編集フォームを表示
    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    // ログインユーザーのプロフィールを更新
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'introduction' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->route('workouts.index')->with('success', 'プロフィールが更新されました！');
    }
}
