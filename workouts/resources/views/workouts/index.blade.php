<!DOCTYPE html>
<html lang="ja">
<head>
    <title>筋トレ記録一覧</title>
</head>
<body>
<h1>筋トレ記録一覧</h1>
<a href="{{ route('workouts.create') }}">新しい記録を追加</a>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

@foreach ($workouts as $workout)
    <div>
        <h2>{{ $workout->exercise_name }}</h2>
        <p>重量: {{ $workout->weight }}kg, 回数: {{ $workout->reps }}回, セット: {{ $workout->sets }}セット</p>
        <p>メモ: {{ $workout->notes }}</p>
        <p>記録日: {{ $workout->created_at->format('Y/m/d H:i') }}</p>

        <a href="{{ route('workouts.edit', $workout->id) }}">編集</a>

        <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </div>
    <hr>
@endforeach
</body>
</html>
