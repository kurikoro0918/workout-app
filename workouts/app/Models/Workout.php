<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    // Userモデルとのリレーション
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // likesとのリレーションを追加
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // ログインユーザーがいいねしているか確認するためのリレーション
    public function likedByMe(): HasOne
    {
        return $this->hasOne(Like::class)->where('user_id', auth()->id());
    }
}
