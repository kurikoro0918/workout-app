<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index'); // 一覧表示
Route::get('/create', [WorkoutController::class, 'create'])->name('workouts.create'); // 新規作成フォーム
Route::post('/', [WorkoutController::class, 'store'])->name('workouts.store'); // 新規作成処理
Route::get('/{id}/edit', [WorkoutController::class, 'edit'])->name('workouts.edit'); // 編集フォーム
Route::put('/{id}', [WorkoutController::class, 'update'])->name('workouts.update'); // 更新処理
Route::delete('/{id}', [WorkoutController::class, 'destroy'])->name('workouts.destroy'); // 削除処理
