<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // この行を追加

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_name',
        'weight',
        'reps',
        'sets',
        'notes',
    ];

    // userメソッドを追加して、Userモデルとのリレーションシップを定義
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
