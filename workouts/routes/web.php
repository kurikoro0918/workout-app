<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\ProfileController;

// 認証機能のルーティング
Auth::routes();

// ログインユーザーのみがアクセス可能なページ
Route::middleware(['auth'])->group(function () {
    Route::get('/my-workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/workouts/create', [WorkoutController::class, 'create'])->name('workouts.create');
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{workout}/edit', [WorkoutController::class, 'edit'])->name('workouts.edit');
    Route::put('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');

    // プロフィール編集機能
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/workouts/{workout}/like', [WorkoutController::class, 'like'])->name('workouts.like');
    Route::delete('/workouts/{workout}/unlike', [WorkoutController::class, 'unlike'])->name('workouts.unlike');
});

// 全ユーザーのタイムライン
Route::get('/', [TimelineController::class, 'index'])->name('timeline.index');

// 特定のユーザーの公開プロフィールページを追加
Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');

// ホームにアクセスした際のリダイレクト
Route::redirect('/home', '/my-workouts');

